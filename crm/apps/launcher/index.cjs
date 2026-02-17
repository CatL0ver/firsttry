#!/usr/bin/env node
/* eslint-disable no-console */
const path = require("path");
const fs = require("fs");
const { spawn } = require("child_process");

const root = process.cwd();
const standaloneServer = path.join(root, "dist", "standalone", "server.js");

if (!fs.existsSync(standaloneServer)) {
  console.error("Standalone build not found. Run: pnpm build:standalone");
  process.exit(1);
}

const port = process.env.PORT || "3000";
const env = {
  ...process.env,
  NODE_ENV: "production",
  PORT: port,
  HOSTNAME: "0.0.0.0",
};

console.log(`Starting CRM on http://localhost:${port}`);
const child = spawn(process.execPath, [standaloneServer], {
  cwd: path.join(root, "dist", "standalone"),
  env,
  stdio: "inherit",
});

child.on("exit", (code) => process.exit(code || 0));
