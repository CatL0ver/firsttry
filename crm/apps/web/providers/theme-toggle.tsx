"use client";

import { useEffect, useState } from "react";

export function ThemeToggle() {
  const [dark, setDark] = useState(false);

  useEffect(() => {
    document.documentElement.classList.toggle("dark", dark);
  }, [dark]);

  return (
    <button className="rounded border px-3 py-2 text-sm" onClick={() => setDark((v) => !v)}>
      {dark ? "Light" : "Dark"}
    </button>
  );
}
