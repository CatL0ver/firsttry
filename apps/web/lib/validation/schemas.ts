import { ShippingType } from "@crm/db";
import { z } from "zod";

export const createCounterpartySchema = z.object({
  name: z.string().min(2),
  hospitalId: z.string().cuid(),
  discountPercent: z.number().min(0).max(100),
});

export const createApplicationSchema = z.object({
  counterpartyId: z.string().cuid(),
  date: z.string().datetime(),
  shippingType: z.nativeEnum(ShippingType),
});
