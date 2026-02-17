import { createInvoiceForApplication } from "@/lib/services/invoice-service";

export async function POST(req: Request, { params }: { params: { id: string } }) {
  const formData = await req.formData();
  const file = formData.get("file");
  if (!(file instanceof File)) {
    return Response.json({ error: "File is required" }, { status: 400 });
  }

  try {
    const invoice = await createInvoiceForApplication(params.id, file);
    return Response.json(invoice, { status: 201 });
  } catch (error) {
    return Response.json({ error: (error as Error).message }, { status: 400 });
  }
}
