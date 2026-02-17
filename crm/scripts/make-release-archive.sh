#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "$0")/.." && pwd)"
RELEASE_DIR="$ROOT_DIR/release"
PACKAGE_DIR="$RELEASE_DIR/crm-portable"
ZIP_PATH="$RELEASE_DIR/crm-portable-win64.zip"

EXE_PATH="$ROOT_DIR/dist/crm-launcher.exe"
STANDALONE_DIR="$ROOT_DIR/dist/standalone"

if [[ ! -f "$EXE_PATH" ]]; then
  echo "[ERROR] Missing $EXE_PATH"
  echo "Run: pnpm build:exe"
  exit 1
fi

if [[ ! -d "$STANDALONE_DIR" ]]; then
  echo "[ERROR] Missing $STANDALONE_DIR"
  echo "Run: pnpm build:standalone"
  exit 1
fi

rm -rf "$PACKAGE_DIR"
mkdir -p "$PACKAGE_DIR/dist"

cp "$EXE_PATH" "$PACKAGE_DIR/crm-launcher.exe"
cp -R "$STANDALONE_DIR" "$PACKAGE_DIR/dist/standalone"
cp "$ROOT_DIR/apps/web/.env.example" "$PACKAGE_DIR/.env.local.example"
cp "$ROOT_DIR/scripts/windows/start-crm.bat" "$PACKAGE_DIR/start-crm.bat"
cp "$ROOT_DIR/docs/INSTALL_WINDOWS_RU.md" "$PACKAGE_DIR/INSTALL_WINDOWS_RU.md"

rm -f "$ZIP_PATH"
(
  cd "$RELEASE_DIR"
  zip -r "$(basename "$ZIP_PATH")" "crm-portable" >/dev/null
)

echo "[OK] Release archive created: $ZIP_PATH"
