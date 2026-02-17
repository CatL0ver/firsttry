import { prisma } from "@crm/db";

export const applicationRepository = {
  list: () =>
    prisma.application.findMany({
      include: {
        counterparty: { include: { hospital: true } },
        invoices: { orderBy: { createdAt: "desc" } },
      },
      orderBy: { date: "desc" },
    }),
  getById: (id: string) =>
    prisma.application.findUnique({
      where: { id },
      include: { invoices: true, counterparty: { include: { hospital: true } } },
    }),
  create: (data: { counterpartyId: string; date: Date; shippingType: "PICKUP" | "COURIER" | "TRANSPORT" }) =>
    prisma.application.create({ data }),
  updateStatus: (id: string, status: "NO_INVOICES" | "WAITING_SECOND" | "WAITING_CONFIRMATION" | "CONFIRMED", confirmed = false) =>
    prisma.application.update({ where: { id }, data: { status, confirmed } }),
};
