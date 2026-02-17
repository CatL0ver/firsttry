import { google } from "googleapis";
import { Readable } from "stream";

function getDriveClient() {
  const auth = new google.auth.GoogleAuth({
    credentials: {
      client_email: process.env.GOOGLE_SERVICE_ACCOUNT_EMAIL,
      private_key: process.env.GOOGLE_SERVICE_ACCOUNT_PRIVATE_KEY?.replace(/\\n/g, "\n"),
    },
    scopes: ["https://www.googleapis.com/auth/drive.file"],
  });
  return google.drive({ version: "v3", auth });
}

export async function uploadToDrive(file: File): Promise<string> {
  const drive = getDriveClient();
  const bytes = Buffer.from(await file.arrayBuffer());
  const folderId = process.env.GOOGLE_DRIVE_INVOICES_FOLDER_ID;

  const response = await drive.files.create({
    requestBody: {
      name: `${Date.now()}-${file.name}`,
      parents: folderId ? [folderId] : undefined,
    },
    media: {
      mimeType: file.type,
      body: Readable.from(bytes),
    },
    fields: "id,webViewLink",
  });

  return response.data.webViewLink ?? `https://drive.google.com/file/d/${response.data.id}/view`;
}
