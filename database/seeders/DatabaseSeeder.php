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
            create_dashboard_introduction::class,
            create_news::class,
            Dokumen::class,
            DocType::class,
            HeroDocumentSeeder::class,
            TipeLaporanSeeder::class,
        ]);
    }
}
