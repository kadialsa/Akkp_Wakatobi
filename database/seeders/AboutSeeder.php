<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Dr. Arham Rumpa, S.St.Pi., M.Si',
                'title' => 'Direktur AKKP Wakatobi',
                'description' => 'Assalamu’alaikum Wr. Wb...',
                'image' => 'default.jpg',
            ]
        );
    }
}
