<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use DokumenSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            create_user_admin::class,
            createFakePasswordResetRequest::class,
            createRole::class,
            allowedUser::class,
            dashboard::class,
            NewsSeeder::class,
//            Dokumen::class,
            DocType::class,
            Dokumen::class,
            HeroDocumentSeeder::class,
            TipeLaporanSeeder::class,
            accountableSeeder::class,
//            informableSeeder::class,
            responsibleSeeder::class,
            bawahanSeeder::class,
            JenisLaporanSeeder::class,
//            KategoriLaporanSeeder::class,
            LogLaporanSeeder::class,
        ]);
    }
}
