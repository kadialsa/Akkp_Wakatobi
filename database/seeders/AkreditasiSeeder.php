<?php

namespace Database\Seeders;

use App\Models\Akreditasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AkreditasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Akreditasi::insert([

            [
                'type'=>'kampus',
                'title'=>'Akreditasi Institusi',
                'badge'=>'Terakreditasi Baik',
                'badge_color'=>'success',
                'description'=>'Institusi telah terakreditasi sebagai jaminan mutu pendidikan.'
            ],

            [
                'type'=>'konservasi',
                'title'=>'Akreditasi Program Studi Konservasi',
                'badge'=>'Baik',
                'badge_color'=>'primary',
                'description'=>'Program studi konservasi terakreditasi.'
            ],

            [
                'type'=>'ekowisata',
                'title'=>'Akreditasi Ekowisata Bahari',
                'badge'=>'Baik',
                'badge_color'=>'warning',
                'description'=>'Program studi ekowisata bahari terakreditasi.'
            ]

        ]);
    }
}
