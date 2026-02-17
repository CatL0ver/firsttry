#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "$0")/.." && pwd)"
ARCHIVE_PATH="$ROOT_DIR/release/crm-portable-win64.zip"
TAG="${1:-}"
TITLE="${2:-CRM Portable Release}"

if [[ -z "$TAG" ]]; then
  echo "Usage: bash scripts/publish-release.sh <tag> [title]"
  echo "Example: bash scripts/publish-release.sh v0.1.0 \"CRM v0.1.0\""
  exit 1
fi

if [[ ! -f "$ARCHIVE_PATH" ]]; then
  echo "Archive not found: $ARCHIVE_PATH"
  echo "Run first: cd crm && pnpm build:exe && pnpm release:archive"
  exit 1
fi

if ! command -v gh >/dev/null 2>&1; then
  echo "GitHub CLI (gh) is not installed."
  echo "Install: https://cli.github.com/"
  exit 1
fi

cd "$ROOT_DIR/.."

gh release create "$TAG" "$ARCHIVE_PATH" \
  --title "$TITLE" \
  --notes "Portable Windows archive for CRM: crm-portable-win64.zip"

echo "Release created: $TAG"
