# Mini CRM Monorepo

> Важно: CRM проект находится в папке `crm/` (отделён от legacy файлов в корне репозитория).

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

## Build portable release archive for users (recommended)

```bash
pnpm build:exe
pnpm release:archive
```

Result:
- `release/crm-portable-win64.zip`

User flow after download:
1. Unzip archive
2. Copy `.env.local.example` -> `.env.local`
3. Fill env values
4. Double-click `start-crm.bat`
5. Open `http://localhost:3000`

Detailed guide:
- `docs/INSTALL_WINDOWS_RU.md`

## Publish archive to GitHub Releases

### Automatic (recommended)
- Push tag format: `crm-v*` (example: `crm-v0.1.0`)
- Workflow `.github/workflows/release-crm.yml` builds archive and attaches to release automatically.

### Manual
```bash
pnpm build:exe
pnpm release:archive
bash scripts/publish-release.sh crm-v0.1.0 "CRM v0.1.0"
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
