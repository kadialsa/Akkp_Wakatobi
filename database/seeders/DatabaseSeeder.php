<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\EkowisataTujuanSeeder;
use Database\Seeders\EkowisataKaprodiSeeder;
use Database\Seeders\EkowisataProfileSeeder;
use Database\Seeders\EkowisataVisiMisiSeeder;
use Database\Seeders\EkowisataStrategisSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            StrukturOrganisasiSeeder::class,
            TupoksiSeeder::class,

            EkowisataProfileSeeder::class,
            EkowisataKaprodiSeeder::class,
            EkowisataVisiMisiSeeder::class,
            EkowisataTujuanSeeder::class,
            EkowisataStrategisSeeder::class,
            EkowisataAkreditasSeeder::class,
            EkowisataKurikulumSeeder::class,

            VisiMisiSeeder::class,
            SejarahSeeder::class,

        ]);

        // user admin / testing
        // User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@example.com',
        // ]);
    }
}
