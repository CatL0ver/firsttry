import { counterpartyRepository } from "@/lib/repositories/base-repository";
import { createCounterpartySchema } from "@/lib/validation/schemas";

export async function GET() {
  const counterparties = await counterpartyRepository.list();
  return Response.json(counterparties);
}

export async function POST(req: Request) {
  const body = await req.json();
  const dto = createCounterpartySchema.parse(body);
  const created = await counterpartyRepository.create(dto);
  return Response.json(created, { status: 201 });
}
