# Mini CRM Monorepo

## Structure

- `apps/web` — Next.js 14 app (frontend + API routes)
- `packages/db` — Prisma schema/client
- `packages/ui` — shared ui components

## Quick start

```bash
pnpm install
cp apps/web/.env.example apps/web/.env.local
pnpm db:generate
pnpm --filter @crm/db prisma:migrate
pnpm dev
```

## API

- `POST /api/applications`
- `GET /api/applications`
- `POST /api/applications/[id]/upload`
- `PATCH /api/applications/[id]/confirm`
- `GET /api/counterparties`
- `POST /api/counterparties`
- `GET /api/hospitals`
