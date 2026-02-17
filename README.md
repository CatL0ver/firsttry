# Repository layout

Репозиторий разделён на две части:

- Legacy сайт (ваши старые файлы) — в корне (`index.php`, `styles/`, `img/`, ...)
- Новый CRM проект — в папке [`crm/`](./crm)

## Я обычный пользователь, как скачать и запустить CRM

1. Откройте вкладку **Releases** в GitHub репозитории.
2. Скачайте `crm-portable-win64.zip` из **Assets**.
3. Распакуйте архив в любую папку (например `C:\CRM`).
4. Внутри папки `crm-portable`:
   - скопируйте `.env.local.example` в `.env.local`
   - заполните значения в `.env.local`
   - запустите `start-crm.bat` двойным кликом
5. Откройте `http://localhost:3000`.

Подробный гайд:
- `crm/docs/INSTALL_WINDOWS_RU.md`

## Я разработчик, как собрать архив

```bash
cd crm
pnpm install
pnpm build:exe
pnpm release:archive
```

Готовый архив:
- `crm/release/crm-portable-win64.zip`
