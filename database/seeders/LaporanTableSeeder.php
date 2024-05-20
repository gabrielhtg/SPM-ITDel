<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LaporanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('laporan')->insert([
            [
                'id_tipelaporan' => 1, // Adjust according to your 'jenis_laporan' table
                'direview_oleh' => null, // Adjust according to your 'users' table
                'created_by' => 8, // Adjust according to your 'users' table
                'nama_laporan' => 'Laporan Bulanan',
                'directory' => 'reports/monthly',
                'revisi' => false,
                'status' => 'Menunggu',
                'cek_revisi' => null,
                'approve_at' => null,
                'reject_at' => null,
                'komentar' => 'Initial report submission',
                'file_catatan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_tipelaporan' => 2, // Adjust according to your 'jenis_laporan' table
                'direview_oleh' => 3, // Adjust according to your 'users' table
                'created_by' => 8, // Adjust according to your 'users' table
                'nama_laporan' => 'Laporan Mingguan',
                'directory' => 'reports/weekly',
                'revisi' => false,
                'status' => 'Disetujui',
                'cek_revisi' => 'Perbaikan diperlukan',
                'approve_at' => now(),
                'reject_at' => null,
                'komentar' => 'Weekly report has been approved',
                'file_catatan' => 'notes/revision1.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_tipelaporan' => 3, // Adjust according to your 'jenis_laporan' table
                'direview_oleh' => 3, // Adjust according to your 'users' table
                'created_by' => 8, // Adjust according to your 'users' table
                'nama_laporan' => 'Laporan Harian',
                'directory' => 'reports/daily',
                'revisi' => true,
                'status' => 'Direview',
                'cek_revisi' => null,
                'approve_at' => null,
                'reject_at' => null,
                'komentar' => 'Daily report under review',
                'file_catatan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more entries as needed
        ]);
    }
}
