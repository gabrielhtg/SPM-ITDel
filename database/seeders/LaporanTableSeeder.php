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
            //Dekan FITE
            [
                'id_tipelaporan' => 1, // Adjust according to your 'jenis_laporan' table
                'direview_oleh' => null, // Adjust according to your 'users' table
                'created_by' => 8, // Adjust according to your 'users' table
                'nama_laporan' => 'Laporan Bulanan',
                'directory' => 'src/documents/Laporan_Bulanan.pdf',
                'revisi' => 0,
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
                'nama_laporan' => 'Laporan Bulanan',
                'directory' => 'src/documents/Laporan_Bulanan.pdf',
                'revisi' => 0,
                'status' => 'Disetujui',
                'cek_revisi' => null,
                'approve_at' => now(),
                'reject_at' => null,
                'komentar' => 'Monthly report has been approved',
                'file_catatan' => 'Approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_tipelaporan' => 3, // Adjust according to your 'jenis_laporan' table
                'direview_oleh' => 3, // Adjust according to your 'users' table
                'created_by' => 8, // Adjust according to your 'users' table
                'nama_laporan' => 'Laporan Bulanan',
                'directory' => 'src/documents/Laporan_Bulanan.pdf',
                'revisi' => 1,
                'status' => 'Direview',
                'cek_revisi' => 'Perbaikan diperlukan',
                'approve_at' => null,
                'reject_at' => null,
                'komentar' => 'Monthly report declined',
                'file_catatan' => 'revisi',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            //Dekan FTI
            [
                'id_tipelaporan' => 1, // Adjust according to your 'jenis_laporan' table
                'direview_oleh' => null, // Adjust according to your 'users' table
                'created_by' => 10, // Adjust according to your 'users' table
                'nama_laporan' => 'Laporan Bulanan',
                'directory' => 'src/documents/Laporan_Bulanan.pdf',
                'revisi' => 0,
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
                'created_by' => 10, // Adjust according to your 'users' table
                'nama_laporan' => 'Laporan Bulanan',
                'directory' => 'src/documents/Laporan_Bulanan.pdf',
                'revisi' => 0,
                'status' => 'Disetujui',
                'cek_revisi' => null,
                'approve_at' => now(),
                'reject_at' => null,
                'komentar' => 'Monthly report has been approved',
                'file_catatan' => 'notes/revision1.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_tipelaporan' => 3, // Adjust according to your 'jenis_laporan' table
                'direview_oleh' => 3, // Adjust according to your 'users' table
                'created_by' => 10, // Adjust according to your 'users' table
                'nama_laporan' => 'Laporan Bulanan',
                'directory' => 'src/documents/Laporan_Bulanan.pdf',
                'revisi' => 1,
                'status' => 'Direview',
                'cek_revisi' => 'Perbaikan diperlukan',
                'approve_at' => null,
                'reject_at' => null,
                'komentar' => 'Monthly report declined',
                'file_catatan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            //Dekan Fakultas Vokasi
            [
                'id_tipelaporan' => 1, // Adjust according to your 'jenis_laporan' table
                'direview_oleh' => null, // Adjust according to your 'users' table
                'created_by' => 9, // Adjust according to your 'users' table
                'nama_laporan' => 'Laporan Bulanan',
                'directory' => 'src/documents/Laporan_Bulanan.pdf',
                'revisi' => 0,
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
                'created_by' => 9, // Adjust according to your 'users' table
                'nama_laporan' => 'Laporan Bulanan',
                'directory' => 'src/documents/Laporan_Bulanan.pdf',
                'revisi' => 0,
                'status' => 'Disetujui',
                'cek_revisi' => null,
                'approve_at' => now(),
                'reject_at' => null,
                'komentar' => 'Monthly report has been approved',
                'file_catatan' => 'notes/revision1.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_tipelaporan' => 3, // Adjust according to your 'jenis_laporan' table
                'direview_oleh' => 3, // Adjust according to your 'users' table
                'created_by' => 9, // Adjust according to your 'users' table
                'nama_laporan' => 'Laporan Bulanan',
                'directory' => 'src/documents/Laporan_Bulanan.pdf',
                'revisi' => 1,
                'status' => 'Direview',
                'cek_revisi' => 'Perbaikan diperlukan',
                'approve_at' => null,
                'reject_at' => null,
                'komentar' => 'Monthly report declined',
                'file_catatan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            //Dekan Fakultas Bioteknologi
            [
                'id_tipelaporan' => 1, // Adjust according to your 'jenis_laporan' table
                'direview_oleh' => null, // Adjust according to your 'users' table
                'created_by' => 11, // Adjust according to your 'users' table
                'nama_laporan' => 'Laporan Bulanan',
                'directory' => 'src/documents/Laporan_Bulanan.pdf',
                'revisi' => 0,
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
                'created_by' => 11, // Adjust according to your 'users' table
                'nama_laporan' => 'Laporan Bulanan',
                'directory' => 'src/documents/Laporan_Bulanan.pdf',
                'revisi' => 0,
                'status' => 'Disetujui',
                'cek_revisi' => null,
                'approve_at' => now(),
                'reject_at' => null,
                'komentar' => 'Monthly report has been approved',
                'file_catatan' => 'notes/revision1.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_tipelaporan' => 3, // Adjust according to your 'jenis_laporan' table
                'direview_oleh' => 3, // Adjust according to your 'users' table
                'created_by' => 11, // Adjust according to your 'users' table
                'nama_laporan' => 'Laporan Bulanan',
                'directory' => 'src/documents/Laporan_Bulanan.pdf',
                'revisi' => 1,
                'status' => 'Direview',
                'cek_revisi' => 'Perbaikan diperlukan',
                'approve_at' => null,
                'reject_at' => null,
                'komentar' => 'Monthly report declined',
                'file_catatan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
