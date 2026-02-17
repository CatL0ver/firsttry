# Mini CRM — установка на Windows (через готовый .exe)

## Что вы скачиваете
В релизе есть архив `crm-portable-win64.zip`.
После распаковки в папке будут:
- `crm-launcher.exe`
- `start-crm.bat`
- `dist/standalone/...`
- `.env.local.example`

## Пошагово (без Git опыта)

1. Откройте страницу релизов GitHub проекта.
2. В блоке **Assets** нажмите `crm-portable-win64.zip` и скачайте файл.
3. Распакуйте архив, например в `C:\CRM`.
4. Откройте папку `C:\CRM\crm-portable`.
5. Скопируйте `.env.local.example` в `.env.local`.
6. Откройте `.env.local` в Блокноте и заполните значения:
   - `DATABASE_URL`
   - `GOOGLE_CLIENT_ID`
   - `GOOGLE_CLIENT_SECRET`
   - `GOOGLE_SERVICE_ACCOUNT_EMAIL`
   - `GOOGLE_SERVICE_ACCOUNT_PRIVATE_KEY`
   - `GOOGLE_DRIVE_INVOICES_FOLDER_ID`
   - `NEXTAUTH_SECRET`
   - `NEXTAUTH_URL=http://localhost:3000`
7. Дважды кликните `start-crm.bat`.
8. Откройте браузер: `http://localhost:3000`.

## Если не стартует
- Проверьте, что PostgreSQL запущен и доступен по `DATABASE_URL`.
- Проверьте, что в `.env.local` нет пустых обязательных полей.
- Убедитесь, что папка `dist/standalone` присутствует.
