<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipeLaporan;

class TipeLaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buat contoh data tipe laporan
        $tipe_laporans = [
            ['nama_laporan' => 'Laporan Harian'],
            ['nama_laporan' => 'Laporan Bulanan'],
            ['nama_laporan' => 'Laporan Tahunan'],
            // Tambahkan data lainnya sesuai kebutuhan
        ];

        // Masukkan data ke database
        foreach ($tipe_laporans as $tipe_laporan) {
            TipeLaporan::create($tipe_laporan);
        }
    }
}
