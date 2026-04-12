<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {

        $beritas = Berita::where('status', 'publish')
            ->latest()
            ->paginate(9);

        return view('Berita', compact('beritas'));
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)
            ->where('status', 'publish')
            ->firstOrFail();

        // Tambah 1 view setiap halaman dibuka
        $berita->increment('views');

        return view('details-berita', compact('berita'));
    }
}
