@echo off
setlocal

cd /d %~dp0

if not exist ".\dist\standalone\server.js" (
  echo [ERROR] dist\standalone\server.js not found.
  echo Please unpack full release archive.
  pause
  exit /b 1
)

if not exist ".\.env.local" (
  echo [WARN] .env.local not found.
  echo Copy .env.local.example to .env.local and fill your values.
  pause
)

start "CRM" "%~dp0crm-launcher.exe"
