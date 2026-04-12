<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\ProdiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProdiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $prodis = Prodi::latest()->get();
        return view('admin.prodi.index', compact('prodis'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('admin.prodi.create');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'sejarah_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'kaprodi_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // ===============================
    // Generate Slug Unik
    // ===============================
    $slug = Str::slug($request->name);
    $originalSlug = $slug;
    $count = 1;

    while (Prodi::where('slug', $slug)->exists()) {
        $slug = $originalSlug . '-' . $count++;
    }

    // ===============================
    // Upload Sejarah Image
    // ===============================
    $sejarahImage = null;

    if ($request->hasFile('sejarah_image')) {

        $folder = public_path('uploads/prodi/sejarah');
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        $file = $request->file('sejarah_image');
        $imageName = time() . '_sejarah.' . $file->extension();
        $file->move($folder, $imageName);

        $sejarahImage = 'uploads/prodi/sejarah/' . $imageName;
    }

    // ===============================
    // Upload Kaprodi Photo
    // ===============================
    $kaprodiPhoto = null;

    if ($request->hasFile('kaprodi_photo')) {

        $folder = public_path('uploads/prodi/kaprodi');
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        $file = $request->file('kaprodi_photo');
        $imageName = time() . '_kaprodi.' . $file->extension();
        $file->move($folder, $imageName);

        $kaprodiPhoto = 'uploads/prodi/kaprodi/' . $imageName;
    }

    // ===============================
    // Upload Thumbnail
    // ===============================
    $thumbnail = null;

    if ($request->hasFile('thumbnail')) {

        $folder = public_path('uploads/prodi/thumbnail');
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        $file = $request->file('thumbnail');
        $imageName = time() . '_thumbnail.' . $file->extension();
        $file->move($folder, $imageName);

        $thumbnail = 'uploads/prodi/thumbnail/' . $imageName;
    }

    // ===============================
    // Simpan Prodi
    // ===============================
    $prodi = Prodi::create([
        'name' => $request->name,
        'slug' => $slug,
        'header_title' => $request->header_title,
        'sejarah_title' => $request->sejarah_title,
        'sejarah_content' => $request->sejarah_content,
        'sejarah_image' => $sejarahImage,
        'visi' => $request->visi,
        'tujuan' => $request->tujuan,
        'sasaran' => $request->sasaran,
        'kurikulum_title' => $request->kurikulum_title,
        'kurikulum_content' => $request->kurikulum_content,
        'kaprodi_name' => $request->kaprodi_name,
        'kaprodi_nip' => $request->kaprodi_nip,
        'kaprodi_nidn' => $request->kaprodi_nidn,
        'kaprodi_photo' => $kaprodiPhoto,
        'thumbnail' => $thumbnail,
        'short_description' => $request->short_description,
    ]);

    // ===============================
    // Simpan Misi
    // ===============================
    if ($request->misi) {
        foreach ($request->misi as $key => $misi) {
            ProdiMisi::create([
                'prodi_id' => $prodi->id,
                'content' => $misi,
                'urutan' => $key
            ]);
        }
    }

    return redirect()->route('admin.prodi.index')
        ->with('success', 'Prodi berhasil ditambahkan');
}


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $prodi = Prodi::with('misi')->findOrFail($id);
        return view('admin.prodi.edit', compact('prodi'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
public function update(Request $request, $id)
{
    $prodi = Prodi::findOrFail($id);

    $request->validate([
        'sejarah_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'kaprodi_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // ===============================
    // Update Sejarah Image
    // ===============================
    if ($request->hasFile('sejarah_image')) {

        if ($prodi->sejarah_image && File::exists(public_path($prodi->sejarah_image))) {
            File::delete(public_path($prodi->sejarah_image));
        }

        $folder = public_path('uploads/prodi/sejarah');
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        $file = $request->file('sejarah_image');
        $imageName = time() . '_sejarah.' . $file->extension();
        $file->move($folder, $imageName);

        $prodi->sejarah_image = 'uploads/prodi/sejarah/' . $imageName;
    }

    // ===============================
    // Update Kaprodi Photo
    // ===============================
    if ($request->hasFile('kaprodi_photo')) {

        if ($prodi->kaprodi_photo && File::exists(public_path($prodi->kaprodi_photo))) {
            File::delete(public_path($prodi->kaprodi_photo));
        }

        $folder = public_path('uploads/prodi/kaprodi');
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        $file = $request->file('kaprodi_photo');
        $imageName = time() . '_kaprodi.' . $file->extension();
        $file->move($folder, $imageName);

        $prodi->kaprodi_photo = 'uploads/prodi/kaprodi/' . $imageName;
    }

    // ===============================
    // Update Thumbnail
    // ===============================
    if ($request->hasFile('thumbnail')) {

        if ($prodi->thumbnail && File::exists(public_path($prodi->thumbnail))) {
            File::delete(public_path($prodi->thumbnail));
        }

        $folder = public_path('uploads/prodi/thumbnail');
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        $file = $request->file('thumbnail');
        $imageName = time() . '_thumbnail.' . $file->extension();
        $file->move($folder, $imageName);

        $prodi->thumbnail = 'uploads/prodi/thumbnail/' . $imageName;
    }

    // ===============================
    // Update Data Prodi
    // ===============================
    $prodi->update([
        'name' => $request->name,
        'header_title' => $request->header_title,
        'sejarah_title' => $request->sejarah_title,
        'sejarah_content' => $request->sejarah_content,
        'visi' => $request->visi,
        'tujuan' => $request->tujuan,
        'sasaran' => $request->sasaran,
        'kurikulum_title' => $request->kurikulum_title,
        'kurikulum_content' => $request->kurikulum_content,
        'kaprodi_name' => $request->kaprodi_name,
        'kaprodi_nip' => $request->kaprodi_nip,
        'kaprodi_nidn' => $request->kaprodi_nidn,
        'short_description' => $request->short_description,
    ]);

    // ===============================
    // Update Misi
    // ===============================
    $prodi->misi()->delete();

    if ($request->misi) {
        foreach ($request->misi as $key => $misi) {
            ProdiMisi::create([
                'prodi_id' => $prodi->id,
                'content' => $misi,
                'urutan' => $key
            ]);
        }
    }

    return redirect()->route('admin.prodi.index')
        ->with('success', 'Prodi berhasil diperbarui');
}


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $prodi = Prodi::findOrFail($id);

        if ($prodi->sejarah_image && File::exists(public_path($prodi->sejarah_image))) {
            File::delete(public_path($prodi->sejarah_image));
        }

        if ($prodi->kaprodi_photo && File::exists(public_path($prodi->kaprodi_photo))) {
            File::delete(public_path($prodi->kaprodi_photo));
        }

        $prodi->misi()->delete();
        $prodi->delete();

        return redirect()->route('admin.prodi.index')
            ->with('success', 'Prodi berhasil dihapus');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW (PUBLIC)
    |--------------------------------------------------------------------------
    */
    public function show($slug)
    {
        $prodi = Prodi::with('misi')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('Admin.Prodi.show', compact('prodi'));
    }
}
