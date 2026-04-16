<?php

namespace App\Http\Controllers;

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

        // ================= IMAGE =================
        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $folder = public_path('uploads/akreditas/imgakreditas');
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            $name = uniqid() . '.' . $file->getClientOriginalExtension();

            if ($file->move($folder, $name)) {
                $data['image'] = 'uploads/akreditas/imgakreditas/' . $name;
            }
        }

        // ================= FILE =================
        if ($request->hasFile('file')) {

            $file = $request->file('file');

            $folder = public_path('uploads/akreditas/fileakreditas');
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            $name = uniqid() . '.' . $file->getClientOriginalExtension();

            if ($file->move($folder, $name)) {
                $data['file'] = 'uploads/akreditas/fileakreditas/' . $name;
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

        // ================= IMAGE UPDATE =================
        if ($request->hasFile('image')) {

            if ($akreditasi->image && file_exists(public_path($akreditasi->image))) {
                unlink(public_path($akreditasi->image));
            }

            $file = $request->file('image');

            $folder = public_path('uploads/akreditas/imgakreditas');
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            $name = uniqid() . '.' . $file->getClientOriginalExtension();

            if ($file->move($folder, $name)) {
                $data['image'] = 'uploads/akreditas/imgakreditas/' . $name;
            }
        }

        // ================= FILE UPDATE =================
        if ($request->hasFile('file')) {

            if ($akreditasi->file && file_exists(public_path($akreditasi->file))) {
                unlink(public_path($akreditasi->file));
            }

            $file = $request->file('file');

            $folder = public_path('uploads/akreditas/fileakreditas');
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            $name = uniqid() . '.' . $file->getClientOriginalExtension();

            if ($file->move($folder, $name)) {
                $data['file'] = 'uploads/akreditas/fileakreditas/' . $name;
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

        if ($item->image && file_exists(public_path($item->image))) {
            unlink(public_path($item->image));
        }

        if ($item->file && file_exists(public_path($item->file))) {
            unlink(public_path($item->file));
        }

        $item->delete();

        return redirect()->route('admin.akreditasi.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
