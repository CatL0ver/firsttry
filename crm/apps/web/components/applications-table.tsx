"use client";

import { Badge } from "@crm/ui";
import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";
import { useMemo, useState } from "react";
import { toast } from "sonner";
import { InvoiceUploadDropzone } from "@/components/invoice-upload-dropzone";

type ApplicationRow = {
  id: string;
  date: string;
  shippingType: string;
  status: "NO_INVOICES" | "WAITING_SECOND" | "WAITING_CONFIRMATION" | "CONFIRMED";
  confirmed: boolean;
  counterparty: { id: string; name: string; discountPercent: string; hospital: { id: string; name: string } };
  invoices: { id: string; invoiceNumber: string; driveUrl: string }[];
};

const statusMap = {
  NO_INVOICES: { label: "Без счетов", variant: "destructive" as const },
  WAITING_SECOND: { label: "Ожидает 2-й", variant: "warning" as const },
  WAITING_CONFIRMATION: { label: "Ожидает подтверждения", variant: "secondary" as const },
  CONFIRMED: { label: "Подтверждено", variant: "success" as const },
};

export function ApplicationsTable() {
  const qc = useQueryClient();
  const [hospital, setHospital] = useState("all");
  const [counterparty, setCounterparty] = useState("all");
  const [date, setDate] = useState("");

  const appQuery = useQuery({
    queryKey: ["applications"],
    queryFn: async () => (await fetch("/api/applications")).json() as Promise<ApplicationRow[]>,
  });
  const counterpartyQuery = useQuery({
    queryKey: ["counterparties"],
    queryFn: async () => (await fetch("/api/counterparties")).json() as Promise<ApplicationRow["counterparty"][]>,
  });

  const confirmMutation = useMutation({
    mutationFn: async (id: string) => fetch(`/api/applications/${id}/confirm`, { method: "PATCH" }),
    onMutate: async (id) => {
      await qc.cancelQueries({ queryKey: ["applications"] });
      const previous = qc.getQueryData<ApplicationRow[]>(["applications"]);
      if (previous) {
        qc.setQueryData(
          ["applications"],
          previous.map((row) => (row.id === id ? { ...row, status: "CONFIRMED", confirmed: true } : row)),
        );
      }
      return { previous };
    },
    onError: (_, __, context) => {
      if (context?.previous) qc.setQueryData(["applications"], context.previous);
      toast.error("Ошибка подтверждения");
    },
    onSuccess: () => toast.success("Заявка подтверждена"),
    onSettled: () => qc.invalidateQueries({ queryKey: ["applications"] }),
  });

  const rows = useMemo(() => {
    const raw = appQuery.data ?? [];
    return raw.filter((item) => {
      const byHospital = hospital === "all" || item.counterparty.hospital.id === hospital;
      const byCounterparty = counterparty === "all" || item.counterparty.id === counterparty;
      const byDate = !date || item.date.slice(0, 10) === date;
      return byHospital && byCounterparty && byDate;
    });
  }, [appQuery.data, hospital, counterparty, date]);

  return (
    <section className="space-y-4">
      <h1 className="text-2xl font-bold">Mini CRM</h1>
      <div className="grid grid-cols-1 gap-2 md:grid-cols-3">
        <select className="rounded border p-2" value={hospital} onChange={(e) => setHospital(e.target.value)}>
          <option value="all">Все больницы</option>
          {[...(counterpartyQuery.data ?? []).reduce((map, c) => map.set(c.hospital.id, c.hospital.name), new Map<string, string>())].map(([id, name]) => (
            <option key={id} value={id}>{name}</option>
          ))}
        </select>
        <select className="rounded border p-2" value={counterparty} onChange={(e) => setCounterparty(e.target.value)}>
          <option value="all">Все контрагенты</option>
          {(counterpartyQuery.data ?? []).map((c) => (
            <option key={c.id} value={c.id}>{c.name}</option>
          ))}
        </select>
        <input className="rounded border p-2" type="date" value={date} onChange={(e) => setDate(e.target.value)} />
      </div>

      <div className="overflow-x-auto rounded border">
        <table className="min-w-full text-sm">
          <thead className="bg-secondary">
            <tr>
              <th className="p-3 text-left">Контрагент</th>
              <th className="p-3 text-left">Больница</th>
              <th className="p-3 text-left">Скидка (%)</th>
              <th className="p-3 text-left">Номер счета</th>
              <th className="p-3 text-left">Статус</th>
              <th className="p-3 text-left">Дата</th>
              <th className="p-3 text-left">Тип отправки</th>
              <th className="p-3 text-left">Действия</th>
            </tr>
          </thead>
          <tbody>
            {rows.map((row) => (
              <tr key={row.id} className="border-t align-top">
                <td className="p-3">{row.counterparty.name}</td>
                <td className="p-3">{row.counterparty.hospital.name}</td>
                <td className="p-3">{row.counterparty.discountPercent}</td>
                <td className="p-3">
                  {row.invoices.map((inv) => (
                    <a key={inv.id} className="block underline" href={inv.driveUrl} target="_blank">{inv.invoiceNumber}</a>
                  ))}
                </td>
                <td className="p-3">
                  <Badge variant={statusMap[row.status].variant}>{statusMap[row.status].label}</Badge>
                </td>
                <td className="p-3">{new Date(row.date).toLocaleDateString()}</td>
                <td className="p-3">{row.shippingType}</td>
                <td className="space-y-2 p-3">
                  <InvoiceUploadDropzone applicationId={row.id} onUploaded={() => qc.invalidateQueries({ queryKey: ["applications"] })} />
                  <button
                    className="rounded border px-2 py-1 disabled:opacity-50"
                    disabled={row.confirmed || row.invoices.length < 2}
                    onClick={() => confirmMutation.mutate(row.id)}
                  >
                    Confirm
                  </button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </section>
  );
}
