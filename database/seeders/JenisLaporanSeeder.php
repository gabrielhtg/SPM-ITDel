<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JenisLaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array of months for the year 2024
        $months = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        // ID of the 'Laporan Bulanan' tipe_laporan
        $tipeLaporanBulananId = DB::table('tipe_laporan')->where('nama_laporan', 'Laporan Bulanan')->first()->id;
        $tipeLaporanTriwulanId = DB::table('tipe_laporan')->where('nama_laporan', 'Laporan TriWulan')->first()->id;

        // Create entries for each month
        foreach ($months as $index => $month) {
            DB::table('jenis_laporan')->insert([
                'id_tipelaporan' => $tipeLaporanBulananId,
                'nama' => $month ,
                'year' => 2024,
                'end_date' => Carbon::createFromDate(2024, $index + 1, 1)->endOfMonth(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Create entries for each quarter ending month
        $quarterEndingMonths = [
            'Maret', 'Juni', 'September', 'Desember'
        ];

        foreach ($quarterEndingMonths as $index => $month) {
            DB::table('jenis_laporan')->insert([
                'id_tipelaporan' => $tipeLaporanTriwulanId,
                'nama' => $month ,
                'year' => 2024,
                'end_date' => Carbon::createFromDate(2024, ($index + 1) * 3, 1)->endOfMonth(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
