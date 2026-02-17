# Mini CRM — установка на Windows (через готовый .exe)

## Что вы скачиваете
В релизе есть архив `crm-portable-win64.zip`.
После распаковки в папке будут:
- `crm-launcher.exe`
- `start-crm.bat`
- `dist/standalone/...`
- `.env.local.example`

## Пошагово (без Git опыта)

1. Откройте страницу репозитория на GitHub.
2. Нажмите вкладку **Releases** (справа обычно есть блок Releases).
3. Откройте последний релиз.
4. В блоке **Assets** нажмите `crm-portable-win64.zip` и скачайте файл.
5. Распакуйте архив, например в `C:\CRM`.
6. Откройте папку `C:\CRM\crm-portable`.
7. Скопируйте `.env.local.example` в `.env.local`.
8. Откройте `.env.local` в Блокноте и заполните значения:
   - `DATABASE_URL`
   - `GOOGLE_CLIENT_ID`
   - `GOOGLE_CLIENT_SECRET`
   - `GOOGLE_SERVICE_ACCOUNT_EMAIL`
   - `GOOGLE_SERVICE_ACCOUNT_PRIVATE_KEY`
   - `GOOGLE_DRIVE_INVOICES_FOLDER_ID`
   - `NEXTAUTH_SECRET`
   - `NEXTAUTH_URL=http://localhost:3000`
9. Дважды кликните `start-crm.bat`.
10. Откройте браузер: `http://localhost:3000`.

## Если релиза ещё нет (для владельца репозитория)

### Автоматически через GitHub Actions
1. Убедитесь, что код с workflow в `main`.
2. Создайте git tag вида `crm-v0.1.0` и запушьте его.
3. GitHub Action сам соберёт архив и прикрепит его к Release.

### Вручную через GitHub UI
1. Соберите архив локально:
   - `cd crm`
   - `pnpm build:exe`
   - `pnpm release:archive`
2. На GitHub нажмите **Releases** -> **Draft a new release**.
3. Введите тег (например `crm-v0.1.0`) и заголовок.
4. Прикрепите файл `crm/release/crm-portable-win64.zip`.
5. Нажмите **Publish release**.

## Если не стартует
- Проверьте, что PostgreSQL запущен и доступен по `DATABASE_URL`.
- Проверьте, что в `.env.local` нет пустых обязательных полей.
- Убедитесь, что папка `dist/standalone` присутствует.
