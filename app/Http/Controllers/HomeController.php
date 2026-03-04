<?php

namespace App\Http\Controllers;

use App\Models\Sliders;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Cooperation;
use App\Models\VisiMisi;
use App\Models\Berita;
use App\Models\Prodi;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Ambil slider aktif
        $sliders = Sliders::where('is_active', 1)
            ->orderBy('position')
            ->get();

        $cooperations = Cooperation::where('is_active', 1)
            ->orderBy('position')
            ->get();

        // Ambil About pertama dari database
        $about = About::first();;

        // 🔥 Ambil 3 berita terbaru
        $beritaTerbaru = Berita::orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        $prodis = Prodi::latest()->get();

        // Kirim ke view
        return view('home', compact(
            'sliders',
            'about',
            'cooperations',
            'beritaTerbaru',
            'prodis'
        ));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
