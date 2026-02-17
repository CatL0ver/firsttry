import fs from "node:fs";
import path from "node:path";

const root = process.cwd();
const webRoot = path.join(root, "apps", "web");
const outRoot = path.join(root, "dist");
const standaloneOut = path.join(outRoot, "standalone");

fs.rmSync(outRoot, { recursive: true, force: true });
fs.mkdirSync(standaloneOut, { recursive: true });

copyDir(path.join(webRoot, ".next", "standalone"), standaloneOut);
copyDir(path.join(webRoot, ".next", "static"), path.join(standaloneOut, ".next", "static"));

const publicDir = path.join(webRoot, "public");
if (fs.existsSync(publicDir)) {
  copyDir(publicDir, path.join(standaloneOut, "public"));
}

console.log("Prepared standalone build in dist/standalone");

function copyDir(src, dest) {
  fs.mkdirSync(dest, { recursive: true });
  for (const entry of fs.readdirSync(src, { withFileTypes: true })) {
    const srcPath = path.join(src, entry.name);
    const destPath = path.join(dest, entry.name);
    if (entry.isDirectory()) {
      copyDir(srcPath, destPath);
    } else {
      fs.copyFileSync(srcPath, destPath);
    }
  }
}
