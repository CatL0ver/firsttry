# Mini CRM Monorepo

## Structure

- `apps/web` — Next.js 14 app (frontend + API routes)
- `packages/db` — Prisma schema/client
- `packages/ui` — shared ui components
- `apps/launcher` — Windows launcher builder (`crm-launcher.exe`)

## Quick start

```bash
pnpm install
cp apps/web/.env.example apps/web/.env.local
pnpm db:generate
pnpm --filter @crm/db prisma:migrate
pnpm dev
```

## Build Windows EXE launcher

```bash
pnpm build:exe
```

Result:
- `dist/standalone` — production standalone Next.js build
- `dist/crm-launcher.exe` — launcher executable (Windows)

Run on Windows:
```powershell
.\dist\crm-launcher.exe
```

## Move project to new repository `CatL0ver/crm`

```bash
pnpm repo:catlover
# then
# git push -u origin <your-branch>
```

## API

- `POST /api/applications`
- `GET /api/applications`
- `POST /api/applications/[id]/upload`
- `PATCH /api/applications/[id]/confirm`
- `GET /api/counterparties`
- `POST /api/counterparties`
- `GET /api/hospitals`
