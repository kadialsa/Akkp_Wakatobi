<?php

namespace App\Http\Controllers;

use App\Models\Akreditasi;
use Illuminate\Http\Request;

use App\Models\EkowisataKaprodi;
use App\Models\EkowisataKurikulum;
use App\Models\EkowisataProfile;
use App\Models\EkowisataVisiMisi;
use App\Models\EkowisataTujuan;
use App\Models\EkowisataStrategis;

class EkowisataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('ekowisata', [
        'sejarah'   => EkowisataProfile::first(),
        'kaprodi'   => EkowisataKaprodi::first(),

         // VISI & MISI DIPISAH
            'visi'     => EkowisataVisiMisi::where('type', 'visi')->first(),
            'misi'     => EkowisataVisiMisi::where('type', 'misi')->get(),

        'tujuan'    => EkowisataTujuan::first(),
        'sasaran'   => EkowisataStrategis::first(),
        'kurikulum' => EkowisataKurikulum::first(),

         'akreditasi' => Akreditasi::all()->keyBy('type'),

    ]);

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
