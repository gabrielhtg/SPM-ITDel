<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroDocument; // Import model HeroDocument

class HeroDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imagePath = 'logodokumen.jpg';
        HeroDocument::create([
            'titlehero' => 'Manajemen Dokumen',
            'descriptionhero' => 'disini anda dapat melihat setiap document yang tersedia',
            'imagehero' => $imagePath,
        ]);
    }
}
