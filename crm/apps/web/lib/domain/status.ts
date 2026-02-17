import { ApplicationStatus } from "@crm/db";

export function calculateStatus(invoiceCount: number, confirmed: boolean): ApplicationStatus {
  if (confirmed) return ApplicationStatus.CONFIRMED;
  if (invoiceCount <= 0) return ApplicationStatus.NO_INVOICES;
  if (invoiceCount === 1) return ApplicationStatus.WAITING_SECOND;
  return ApplicationStatus.WAITING_CONFIRMATION;
}
