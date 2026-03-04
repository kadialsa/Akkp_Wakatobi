<?php

namespace Database\Seeders;

use App\Models\Sejarah as ModelsSejarah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
class Sejarah extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (ModelsSejarah::count() === 0) {
            Sejarah::create([
                'description' => 'Akademi Komunitas Kelautan dan Perikanan (AKKP) Wakatobi merupakan perguruan tinggi vokasi yang berfokus pada pengembangan sumber daya manusia di bidang kelautan dan perikanan berbasis potensi lokal daerah kepulauan.',
                'image' => null, // foto bisa diubah lewat admin
            ]);
        }
    }
}
