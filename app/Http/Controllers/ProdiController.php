<?php

namespace App\Http\Controllers;

require_once app_path('Helpers/helpers.php');


use App\Models\Prodi;
use App\Models\ProdiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProdiController extends Controller
{

    public function index()
    {
        $prodis = Prodi::latest()->get();
        return view('Admin.Prodi.index', compact('prodis'));
    }

    public function create()
    {
        return view('Admin.Prodi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sejarah_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kaprodi_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 🔥 slug unik
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $count = 1;

        while (Prodi::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        // 🔥 upload
        $sejarahImage = $request->hasFile('sejarah_image')
            ? uploadFile($request->file('sejarah_image'), 'prodi/sejarah')
            : null;

        $kaprodiPhoto = $request->hasFile('kaprodi_photo')
            ? uploadFile($request->file('kaprodi_photo'), 'prodi/kaprodi')
            : null;

        $thumbnail = $request->hasFile('thumbnail')
            ? uploadFile($request->file('thumbnail'), 'prodi/thumbnail')
            : null;

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


    public function edit($id)
    {
        $prodi = Prodi::with('misi')->findOrFail($id);
        return view('Admin.Prodi.edit', compact('prodi'));
    }

    public function update(Request $request, $id)
    {
        $prodi = Prodi::findOrFail($id);

        $request->validate([
            'sejarah_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kaprodi_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 🔥 upload + auto delete
        if ($request->hasFile('sejarah_image')) {
            $prodi->sejarah_image = uploadFile(
                $request->file('sejarah_image'),
                'prodi/sejarah',
                $prodi->sejarah_image
            );
        }

        if ($request->hasFile('kaprodi_photo')) {
            $prodi->kaprodi_photo = uploadFile(
                $request->file('kaprodi_photo'),
                'prodi/kaprodi',
                $prodi->kaprodi_photo
            );
        }

        if ($request->hasFile('thumbnail')) {
            $prodi->thumbnail = uploadFile(
                $request->file('thumbnail'),
                'prodi/thumbnail',
                $prodi->thumbnail
            );
        }

        // 🔥 update data
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

        // 🔥 reset misi
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


    public function destroy($id)
    {
        $prodi = Prodi::findOrFail($id);

        // 🔥 hapus file
        deleteFile($prodi->sejarah_image, 'prodi/sejarah');
        deleteFile($prodi->kaprodi_photo, 'prodi/kaprodi');
        deleteFile($prodi->thumbnail, 'prodi/thumbnail');

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
