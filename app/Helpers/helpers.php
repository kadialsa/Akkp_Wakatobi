<?php

if (!function_exists('uploadFile')) {

    function uploadFile($file, $folder, $oldFile = null)
    {
        try {
            $basePath = public_path('uploads/' . $folder);

            // Buat folder jika belum ada
            if (!is_dir($basePath)) {
                mkdir($basePath, 0755, true);
            }

            // Hapus file lama
            if ($oldFile && file_exists($basePath . '/' . $oldFile)) {
                unlink($basePath . '/' . $oldFile);
            }

            // Nama unik
            $fileName = time() . '_' . bin2hex(random_bytes(5)) . '.' . $file->getClientOriginalExtension();

            // Upload
            $file->move($basePath, $fileName);

            return $fileName;

        } catch (\Throwable $e) {
            return null;
        }
    }
}

if (!function_exists('deleteFile')) {

    function deleteFile($folder, $fileName)
    {
        $path = public_path('uploads/' . $folder . '/' . $fileName);

        if (file_exists($path)) {
            unlink($path);
        }
    }
}
