<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Struktur;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;

use App\Models\Leader;

class StrukturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data pertama dari tabel struktur_organisasi
        $struktur = StrukturOrganisasi::first();
        $sections = Section::with('leaders')->get();


        // Kirim data ke view 'Struktur' (Struktur.blade.php)
        return view('Struktur', compact('struktur','sections'));
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
    public function show(Struktur $struktur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Struktur $struktur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Struktur $struktur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Struktur $struktur)
    {
        //
    }
}
