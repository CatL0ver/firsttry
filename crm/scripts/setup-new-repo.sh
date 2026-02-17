#!/usr/bin/env bash
set -euo pipefail

TARGET_REMOTE="git@github.com:CatL0ver/crm.git"

if ! git remote get-url origin >/dev/null 2>&1; then
  git remote add origin "$TARGET_REMOTE"
else
  git remote set-url origin "$TARGET_REMOTE"
fi

echo "Origin set to $TARGET_REMOTE"
echo "Now run:"
echo "  git push -u origin $(git branch --show-current)"
