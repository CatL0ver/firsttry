import { applicationRepository } from "@/lib/repositories/application-repository";
import { calculateStatus } from "@/lib/domain/status";

export async function PATCH(_: Request, { params }: { params: { id: string } }) {
  const app = await applicationRepository.getById(params.id);
  if (!app) {
    return Response.json({ error: "Not found" }, { status: 404 });
  }

  const status = calculateStatus(app.invoices.length, true);
  const updated = await applicationRepository.updateStatus(params.id, status, true);
  return Response.json(updated);
}
