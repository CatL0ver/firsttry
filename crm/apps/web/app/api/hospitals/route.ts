import { hospitalRepository } from "@/lib/repositories/base-repository";

export async function GET() {
  const hospitals = await hospitalRepository.list();
  return Response.json(hospitals);
}
