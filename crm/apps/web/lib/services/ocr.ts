import Tesseract from "tesseract.js";

export async function extractInvoiceNumber(file: File): Promise<string> {
  const arrayBuffer = await file.arrayBuffer();
  const { data } = await Tesseract.recognize(Buffer.from(arrayBuffer), "eng+rus");
  const match = data.text.match(/(?:invoice|счет|№)\s*[:#-]?\s*([A-Z0-9-]{4,})/i);
  return match?.[1] ?? `UNKNOWN-${Date.now()}`;
}
