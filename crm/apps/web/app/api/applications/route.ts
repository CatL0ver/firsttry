import { applicationRepository } from "@/lib/repositories/application-repository";
import { createApplicationSchema } from "@/lib/validation/schemas";

export async function GET() {
  const applications = await applicationRepository.list();
  return Response.json(applications);
}

export async function POST(req: Request) {
  const body = await req.json();
  const dto = createApplicationSchema.parse(body);

  const created = await applicationRepository.create({
    counterpartyId: dto.counterpartyId,
    date: new Date(dto.date),
    shippingType: dto.shippingType,
  });

  return Response.json(created, { status: 201 });
}
