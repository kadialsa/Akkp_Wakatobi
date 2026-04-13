<?php

namespace App\Http\Controllers;

use App\Models\Sliders;
use Illuminate\Http\Request;

class SlidersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Sliders::orderBy('position');

        // Jika ada fitur search
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $sliders = $query->paginate(10);

        return view('Admin.slides', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Slide-add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'required|image|mimes:jpg,jpeg,png',
            'is_active'   => 'required|boolean',
            'position'    => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/sliders'), $filename);
            $data['image'] = $filename;
        }

        Sliders::create($data);

        return redirect()->route('admin.slides.index')
            ->with('status', 'Slider berhasil ditambahkan');
    }



    /**
     * Display the specified resource.
     */
    public function show(Sliders $sliders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sliders $slider)
    {
        return view('Admin.Slide-edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sliders $slider)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png',
            'is_active'   => 'required|boolean',
            'position'    => 'nullable|integer',
        ]);

        // jika upload gambar baru
        if ($request->hasFile('image')) {

            // hapus gambar lama
            $oldImage = public_path('uploads/sliders/' . $slider->image);
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }

            // upload gambar baru
            $image = $request->file('image');
            $filename = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/sliders'), $filename);

            $data['image'] = $filename;
        }

        $slider->update($data);

        return redirect()->route('admin.slides.index')
            ->with('status', 'Slider berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sliders $slider)
    {
        // hapus file gambar jika ada
        $imagePath = public_path('uploads/sliders/' . $slider->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // hapus data dari database
        $slider->delete();

        return redirect()->route('admin.slides.index')
            ->with('status', 'Slider berhasil dihapus');
    }
}
