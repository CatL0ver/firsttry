import { prisma } from "@crm/db";

export const hospitalRepository = {
  list: () => prisma.hospital.findMany({ orderBy: { name: "asc" } }),
};

export const counterpartyRepository = {
  list: () => prisma.counterparty.findMany({ include: { hospital: true }, orderBy: { name: "asc" } }),
  create: (data: { name: string; hospitalId: string; discountPercent: number }) =>
    prisma.counterparty.create({
      data: { ...data, discountPercent: data.discountPercent },
      include: { hospital: true },
    }),
};
