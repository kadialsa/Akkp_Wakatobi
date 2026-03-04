<?php

namespace Database\Seeders;

use App\Models\VisiMisi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisiMisiSeeder extends Seeder
{
    public function run(): void
    {
        // Cegah duplikasi data
        if (VisiMisi::count() == 0) {
            VisiMisi::create([
                'visi' => 'Menjadi organisasi yang berperan aktif dalam pelestarian lingkungan dan pemberdayaan masyarakat pesisir.',
                'misi' => '1. Meningkatkan kesadaran masyarakat terhadap pentingnya menjaga ekosistem laut.
2. Mengembangkan program ekowisata berkelanjutan.
3. Mendukung konservasi sumber daya alam melalui edukasi dan aksi nyata.',
            ]);
        }
    }
}
