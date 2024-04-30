<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KategoriLaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data untuk dimasukkan ke dalam tabel jenis_laporan
        $data = [];
        
        // Loop untuk setiap bulan dalam tahun 2024
        for ($i = 1; $i <= 12; $i++) {
            // Tentukan tanggal awal dan akhir bulan
            $startDate = Carbon::createFromDate(2024, $i, 1)->startOfMonth()->toDateTimeString();
            $endDate = Carbon::createFromDate(2024, $i, 1)->endOfMonth()->toDateTimeString();
            
            // Tambahkan data untuk bulan ini ke dalam array
            $data[] = [
                'id_tipelaporan' => 1,
                'nama' => Carbon::createFromDate(2024, $i, 1)->format('F Y'), // Nama bulan dan tahun
                'start_date' => $startDate,
                'end_date' => $endDate,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Jika bulan adalah Maret, Juni, September, atau Desember, tambahkan data untuk triwulan
            if (in_array($i, [3, 6, 9, 12])) {
                $data[] = [
                    'id_tipelaporan' => 2,
                    'nama' => 'Triwulan ' . Carbon::createFromDate(2024, $i, 1)->format('F Y'),
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Tambahkan data untuk semester genap dan ganjil
        $data[] = [
            'id_tipelaporan' => 3,
            'nama' => 'Semester Genap 2023/2024',
            'start_date' => Carbon::createFromDate(2023, 12, 1)->toDateTimeString(),
            'end_date' => Carbon::createFromDate(2024, 5, 31)->toDateTimeString(),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $data[] = [
            'id_tipelaporan' => 3,
            'nama' => 'Semester Ganjil 2024/2025',
            'start_date' => Carbon::createFromDate(2024, 6, 1)->toDateTimeString(),
            'end_date' => Carbon::createFromDate(2024, 11, 30)->toDateTimeString(),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Tambahkan data untuk laporan tahunan
        $data[] = [
            'id_tipelaporan' => 4,
            'nama' => 'Tahunan 2024',
            'start_date' => Carbon::createFromDate(2024, 1, 1)->toDateTimeString(),
            'end_date' => Carbon::createFromDate(2024, 12, 31)->toDateTimeString(),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Masukkan data ke dalam tabel menggunakan metode insert dari Query Builder
        DB::table('jenis_laporan')->insert($data);
    }
}
