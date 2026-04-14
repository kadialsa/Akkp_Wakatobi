<?php

namespace App\Http\Controllers;

use App\Models\Sliders;
use Illuminate\Http\Request;

class SlidersController extends Controller
{
    // ========================
    // INDEX
    // ========================
    public function index(Request $request)
    {
        $query = Sliders::orderBy('position');

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $sliders = $query->paginate(10);

        return view('Admin.Slides', compact('sliders'));
    }

    // ========================
    // CREATE
    // ========================
    public function create()
    {
        return view('Admin.Slide-add');
    }

    // ========================
    // STORE
    // ========================
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'required|image|mimes:jpg,jpeg,png',
            'is_active'   => 'required|boolean',
            'position'    => 'nullable|integer',
        ]);

        // 🔥 Upload pakai helper
        if ($request->hasFile('image')) {

            $file = $request->file('image');

            if ($file && $file->isValid()) {

                $imageName = uploadFile($file, 'sliders');

                if (!$imageName) {
                    return back()->with('error', 'Gagal upload gambar');
                }

                $data['image'] = $imageName;
            }
        }

        Sliders::create($data);

        return redirect()->route('admin.slides.index')
            ->with('success', 'Slider berhasil ditambahkan');
    }

    // ========================
    // EDIT
    // ========================
    public function edit(Sliders $slider)
    {
        return view('Admin.Slide-edit', compact('slider'));
    }

    // ========================
    // UPDATE
    // ========================
    public function update(Request $request, Sliders $slider)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png',
            'is_active'   => 'required|boolean',
            'position'    => 'nullable|integer',
        ]);

        // 🔥 Upload + replace pakai helper
        if ($request->hasFile('image')) {

            $file = $request->file('image');

            if ($file && $file->isValid()) {

                $imageName = uploadFile(
                    $file,
                    'sliders',
                    $slider->image // 🔥 hapus file lama otomatis
                );

                if (!$imageName) {
                    return back()->with('error', 'Gagal upload gambar');
                }

                $data['image'] = $imageName;
            }
        }

        $slider->update($data);

        return redirect()->route('admin.slides.index')
            ->with('success', 'Slider berhasil diperbarui');
    }

    // ========================
    // DELETE
    // ========================
    public function destroy(Sliders $slider)
    {
        // 🔥 delete pakai helper
        deleteFile($slider->image, 'sliders');

        $slider->delete();

        return redirect()->route('admin.slides.index')
            ->with('success', 'Slider berhasil dihapus');
    }
}
