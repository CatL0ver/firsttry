"use client";

import { useDropzone } from "react-dropzone";
import { toast } from "sonner";

export function InvoiceUploadDropzone({ applicationId, onUploaded }: { applicationId: string; onUploaded: () => void }) {
  const { getRootProps, getInputProps, isDragActive } = useDropzone({
    maxFiles: 1,
    onDrop: async (acceptedFiles) => {
      const file = acceptedFiles[0];
      if (!file) return;

      const formData = new FormData();
      formData.append("file", file);

      const response = await fetch(`/api/applications/${applicationId}/upload`, { method: "POST", body: formData });
      if (!response.ok) {
        const json = await response.json();
        toast.error(json.error ?? "Upload failed");
        return;
      }

      toast.success("Счет загружен");
      onUploaded();
    },
  });

  return (
    <div {...getRootProps()} className={`cursor-pointer rounded border border-dashed p-2 text-xs ${isDragActive ? "bg-secondary" : ""}`}>
      <input {...getInputProps()} />
      {isDragActive ? "Отпустите файл" : "Drag & drop счет"}
    </div>
  );
}
