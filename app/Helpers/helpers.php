<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (!function_exists('uploadFile')) {

    function uploadFile($file, $folder, $oldFile = null)
    {
        try {
            $path = 'uploads/' . $folder;

            // 🔥 Hapus file lama
            if ($oldFile && Storage::disk('public')->exists($path . '/' . $oldFile)) {
                Storage::disk('public')->delete($path . '/' . $oldFile);
            }

            // 🔥 Nama unik
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

            // 🔥 Upload
            Storage::disk('public')->putFileAs($path, $file, $fileName);

            return $fileName;

        } catch (\Exception $e) {
            return null;
        }
    }
}

if (!function_exists('deleteFile')) {

    function deleteFile($folder, $fileName)
    {
        $path = 'uploads/' . $folder . '/' . $fileName;

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
