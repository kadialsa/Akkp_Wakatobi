<?php

namespace Database\Seeders;

use App\Models\Tupoksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TupoksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tupoksi::create([
            'tugas_pokok' => 'Akademi komunitas kelautan dan perikanan wakatobi mempunyai tugas menyelenggarakan pendidikan vokasi...',
            'fungsi' =>
            "Penyusunan, pemantauan, dan evaluasi rencana, program, dan anggaran.
Penyusunan rencana dan program pendidikan.
Pelaksanaan dan pengembangan pendidikan vokasi.
Pelaksanaan pengawasan internal.",
        ]);
    }
}
