import { prisma } from "@crm/db";
import { applicationRepository } from "@/lib/repositories/application-repository";
import { calculateStatus } from "@/lib/domain/status";
import { extractInvoiceNumber } from "@/lib/services/ocr";
import { uploadToDrive } from "@/lib/services/google-drive";

export async function createInvoiceForApplication(applicationId: string, file: File) {
  const app = await applicationRepository.getById(applicationId);
  if (!app) throw new Error("Application not found");
  if (app.invoices.length >= 2) throw new Error("Application cannot have more than 2 invoices");

  const [driveUrl, invoiceNumber] = await Promise.all([uploadToDrive(file), extractInvoiceNumber(file)]);

  const invoice = await prisma.invoice.create({
    data: {
      applicationId,
      invoiceNumber,
      driveUrl,
    },
  });

  const nextCount = app.invoices.length + 1;
  const status = calculateStatus(nextCount, app.confirmed);
  await applicationRepository.updateStatus(applicationId, status, app.confirmed);

  return invoice;
}
