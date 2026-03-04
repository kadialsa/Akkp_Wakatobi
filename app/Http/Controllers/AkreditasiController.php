<?php

namespace App\Http\Controllers;

use App\Models\Akreditasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AkreditasiController extends Controller
{
    public function index()
    {
        $data = Akreditasi::all()->keyBy('type');
        return view('admin.akreditasi.index', compact('data'));
    }
    public function update(Request $request, $id)
    {
        $item = Akreditasi::findOrFail($id);

        $badgeColors = [
            'Unggul' => 'primary',
            'Baik Sekali' => 'info',
            'Baik' => 'success',
            'Cukup' => 'warning',
            'Tidak Terakreditasi' => 'danger',
        ];

        $data = [
            'title' => $request->title,
            'badge' => $request->badge,
            'badge_color' => $badgeColors[$request->badge] ?? 'secondary',
            'description' => $request->description,
        ];

        // =======================
        // Upload Gambar
        // =======================
        if ($request->hasFile('image')) {

            // hapus gambar lama
            if ($item->image && file_exists(public_path($item->image))) {
                unlink(public_path($item->image));
            }

            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();

            $file->move(
                public_path('uploads/akreditas/imgakreditas'),
                $name
            );

            $data['image'] = 'uploads/akreditas/imgakreditas/' . $name;
        }

        // =======================
        // Upload File PDF
        // =======================
        if ($request->hasFile('file')) {

            if ($item->file && file_exists(public_path($item->file))) {
                unlink(public_path($item->file));
            }

            $file = $request->file('file');
            $name = time() . '_' . $file->getClientOriginalName();

            $file->move(
                public_path('uploads/akreditas/fileakreditas'),
                $name
            );

            $data['file'] = 'uploads/akreditas/fileakreditas/' . $name;
        }

        $item->update($data);

        return back()->with('success', 'Data berhasil diupdate');
    }
}
