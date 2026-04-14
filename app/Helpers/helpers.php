<?php

use Illuminate\Support\Str;

if (!function_exists('uploadFile')) {

    function uploadFile($file, $folder, $oldFile = null)
    {
        try {

            // 🔥 DETEKSI PATH
            if (app()->environment('local')) {
                $basePath = public_path('uploads/' . $folder);
            } else {
                $basePath = '/home/akkpwaka/public_html/profil/uploads/' . $folder;
            }

            // 🔥 Buat folder jika belum ada
            if (!is_dir($basePath)) {
                mkdir($basePath, 0755, true);
            }

            // 🔥 Hapus file lama
            if ($oldFile && file_exists($basePath . '/' . $oldFile)) {
                unlink($basePath . '/' . $oldFile);
            }

            // 🔥 Nama unik
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

            // 🔥 Upload
            $file->move($basePath, $fileName);

            return $fileName;

        } catch (\Throwable $e) {
            return null;
        }
    }
}


// ✅ TAMBAHAN INI
if (!function_exists('deleteFile')) {

    function deleteFile($fileName, $folder)
    {
        try {

            if (!$fileName) return;

            // 🔥 SAMAKAN PATH dengan uploadFile
            if (app()->environment('local')) {
                $basePath = public_path('uploads/' . $folder);
            } else {
                $basePath = '/home/akkpwaka/public_html/profil/uploads/' . $folder;
            }

            $filePath = $basePath . '/' . $fileName;

            if (file_exists($filePath)) {
                unlink($filePath);
            }

        } catch (\Throwable $e) {
            // optional: log error
        }
    }
}
