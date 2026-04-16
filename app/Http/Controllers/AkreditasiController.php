<?php

namespace App\Http\Controllers;

require_once app_path('Helpers/helpers.php');

use App\Models\Akreditasi;
use Illuminate\Http\Request;

class AkreditasiController extends Controller
{

    // ===============================
    // LIST AKREDITASI (ADMIN)
    // ===============================
    public function index()
    {
        $akreditas = Akreditasi::latest()->paginate(10);

        return view('Admin.Akreditasi.index', compact('akreditas'));
    }

    // ===============================
    // FORM CREATE
    // ===============================
    public function create()
    {
        return view('Admin.Akreditasi.create');
    }


    // ===============================
    // STORE DATA
    // ===============================
    public function store(Request $request)
    {
        $badgeColors = [
            'Unggul' => 'primary',
            'Baik Sekali' => 'info',
            'Baik' => 'success',
            'Cukup' => 'warning',
            'Tidak Terakreditasi' => 'danger',
            'Tahap Akreditas' => 'secondary',
        ];

        $request->validate([
            'title' => 'required|string|max:255',
            'badge' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'file'  => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120'
        ]);

        $data = [
            'title' => $request->title,
            'badge' => $request->badge,
            'badge_color' => $badgeColors[$request->badge] ?? 'secondary',
            'description' => $request->description,
        ];

        // ✅ upload image
        if ($request->hasFile('image')) {
            $fileName = uploadFile($request->file('image'), 'akreditas/imgakreditas');
            if ($fileName) {
                $data['image'] = 'uploads/akreditas/imgakreditas/' . $fileName;
            }
        }

        // ✅ upload file
        if ($request->hasFile('file')) {
            $fileName = uploadFile($request->file('file'), 'akreditas/fileakreditas');
            if ($fileName) {
                $data['file'] = 'uploads/akreditas/fileakreditas/' . $fileName;
            }
        }

        Akreditasi::create($data);

        return redirect()->route('admin.akreditasi.index')
            ->with('success', 'Akreditasi berhasil ditambahkan');
    }

    // ===============================
    // SHOW DETAIL
    // ===============================
    public function show($id)
    {
        $akreditasi = Akreditasi::findOrFail($id);

        return view('Admin.Akreditasi.show', compact('akreditasi'));
    }


    // ===============================
    // FORM EDIT
    // ===============================
    public function edit($id)
    {
        $data = Akreditasi::findOrFail($id);
        return view('Admin.Akreditasi.edit', compact('data'));
    }

    // ===============================
    // UPDATE DATA
    // ===============================
    public function update(Request $request, $id)
    {
        $akreditasi = Akreditasi::findOrFail($id);

        $badgeColors = [
            'Unggul' => 'primary',
            'Baik Sekali' => 'info',
            'Baik' => 'success',
            'Cukup' => 'warning',
            'Tidak Terakreditasi' => 'danger',
            'Tahap Akreditas' => 'secondary',
        ];

        $request->validate([
            'title' => 'required|string|max:255',
            'badge' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'file'  => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $data = [
            'title' => $request->title,
            'badge' => $request->badge,
            'badge_color' => $badgeColors[$request->badge] ?? 'secondary',
            'description' => $request->description,
        ];

        // ✅ IMAGE
        if ($request->hasFile('image')) {

            $oldImage = $akreditasi->image
                ? basename($akreditasi->image)
                : null;

            $fileName = uploadFile(
                $request->file('image'),
                'akreditas/imgakreditas',
                $oldImage
            );

            if ($fileName) {
                $data['image'] = 'uploads/akreditas/imgakreditas/' . $fileName;
            }
        }

        // ✅ FILE
        if ($request->hasFile('file')) {

            $oldFile = $akreditasi->file
                ? basename($akreditasi->file)
                : null;

            $fileName = uploadFile(
                $request->file('file'),
                'akreditas/fileakreditas',
                $oldFile
            );

            if ($fileName) {
                $data['file'] = 'uploads/akreditas/fileakreditas/' . $fileName;
            }
        }

        $akreditasi->update($data);

        return redirect()->route('admin.akreditasi.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    // ===============================
    // DELETE
    // ===============================
    public function destroy($id)
    {
        $item = Akreditasi::findOrFail($id);

        if ($item->image) {
            deleteFile(basename($item->image), 'akreditas/imgakreditas');
        }

        if ($item->file) {
            deleteFile(basename($item->file), 'akreditas/fileakreditas');
        }

        $item->delete();

        return redirect()->route('admin.akreditasi.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
