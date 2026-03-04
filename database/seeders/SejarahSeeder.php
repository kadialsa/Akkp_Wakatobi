<?php

namespace Database\Seeders;

use App\Models\Sejarah;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SejarahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Sejarah::count() === 0) {
            Sejarah::create([
                'sejarah' => 'Akademi Komunitas Kelautan dan Perikanan (AKKP) Wakatobi merupakan perguruan tinggi vokasi yang berfokus pada pengembangan sumber daya manusia di bidang kelautan dan perikanan berbasis potensi lokal daerah kepulauan.',
                'foto' => null, // foto bisa diubah lewat admin
            ]);
        }
    }
}
