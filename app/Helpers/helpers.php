<?php

use Illuminate\Support\Str;

function uploadFile($file, $folder, $oldFile = null)
{
    try {

        if (!$file || !$file->isValid()) {
            return null;
        }

        // ✅ gunakan ini
        $basePath = $_SERVER['DOCUMENT_ROOT'] . '/profil/uploads/' . $folder;

        if (!is_dir($basePath)) {
            mkdir($basePath, 0755, true);
        }

        // hapus file lama
        if ($oldFile && file_exists($basePath . '/' . $oldFile)) {
            unlink($basePath . '/' . $oldFile);
        }

        $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

        $file->move($basePath, $fileName);

        return $fileName;

    } catch (\Throwable $e) {
        return null;
    }
}

if (!function_exists('deleteFile')) {

    function deleteFile($fileName, $folder)
    {
        try {

            if (!$fileName) return;

            $basePath = public_path('uploads/' . $folder);
            $filePath = $basePath . '/' . $fileName;

            if (file_exists($filePath)) {
                unlink($filePath);
            }
        } catch (\Throwable $e) {
            // optional
        }
    }
}
