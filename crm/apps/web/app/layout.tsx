import "@/styles/globals.css";
import { QueryProvider } from "@/providers/query-provider";
import { Toaster } from "sonner";
import { ThemeToggle } from "@/providers/theme-toggle";

export default function RootLayout({ children }: { children: React.ReactNode }) {
  return (
    <html lang="ru">
      <body>
        <QueryProvider>
          <main className="mx-auto max-w-7xl p-6">
            <div className="mb-4 flex justify-end">
              <ThemeToggle />
            </div>
            {children}
          </main>
          <Toaster richColors />
        </QueryProvider>
      </body>
    </html>
  );
}
