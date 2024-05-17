<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// Asumsi Anda menggunakan User untuk menentukan responsible, accountable, informable

class createRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['role' => 'Admin', 'status' => true, 'is_admin' => true, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Rektor', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'SPM', 'status' => true, 'is_admin' => false, 'atasan_id' => 2, 'required_to_submit_document' => null],
            ['role' => 'WR 1', 'status' => true, 'is_admin' => false, 'atasan_id' => 2, 'required_to_submit_document' => '3;4'],
            ['role' => 'WR 2', 'status' => true, 'is_admin' => false, 'atasan_id' => 2, 'required_to_submit_document' => '3;4'],
            ['role' => 'WR 3', 'status' => true, 'is_admin' => false, 'atasan_id' => 2, 'required_to_submit_document' => '3;4'],
            ['role' => 'BAAK', 'status' => true, 'is_admin' => false, 'atasan_id' => 4, 'required_to_submit_document' => null],
            ['role' => 'PPKHA', 'status' => true, 'is_admin' => false, 'atasan_id' => 4, 'required_to_submit_document' => null],
            ['role' => 'Ketua GJM', 'status' => true, 'is_admin' => false, 'atasan_id' => 2, 'required_to_submit_document' => null],
            ['role' => 'Anggota GJM', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Ketua GKM', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Anggota GKM', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Ketua SPM', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => '2'],
            ['role' => 'Staff SPM', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Ketua SPI', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => '2'],
            ['role' => 'Staff SPI', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Ketua LPPM', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => '3;4'],
            ['role' => 'Staff LPPM', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Direktur Pendidikan', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => '3'],
            ['role' => 'Member of Direktorat Kemitraan dan Hubungan Masyrakat', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Member of BAA', 'status' => true, 'is_admin' => false, 'atasan_id' => 7, 'required_to_submit_document' => null],
            ['role' => 'Member of Keamanan dan QA', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Member of Lembaga Kemahasiswaaan', 'status' => true, 'is_admin' => false, 'atasan_id' => 7, 'required_to_submit_document' => '3'],
            ['role' => 'Member of Pusat Pembinaan Keasramaan', 'status' => true, 'is_admin' => false, 'atasan_id' => 7, 'required_to_submit_document' => null],
            ['role' => 'Member of Pusat Teknologi dan Sistem Informasi', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Member of SDI', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Member of Divisi Infastruktur ', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Member of UPT PP ESTEM', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Member of SAM', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Member of Perpustakaan', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Member of UPT Bahasa', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Member of Pusat Perencanaan', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Member of PMM', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Member of Logistik', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Member of Keuangan', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Member of Biro Administrasi Umum', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Member of Biro Administrasi Perencanaan dan Sumber Daya', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Member of Biro Administrasi Keuangan', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Member of UPT Kantin', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Member of Kerjasama dan Humas', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Member of Kantor Urusan Internasional', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Member of Pusat Inovasi dan Kewirausahaan', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Member of KHDTK', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Dekan Fakultas Informatika dan Teknik Elektro', 'status' => true, 'is_admin' => false, 'atasan_id' => 2, 'required_to_submit_document' => "2;3;4"],
            ['role' => 'Dekan Fakultas Teknologi Industri', 'status' => true, 'is_admin' => false, 'atasan_id' => 2, 'required_to_submit_document' => "2;3;4"],
            ['role' => 'Dekan Fakultas Bioteknologi', 'status' => true, 'is_admin' => false, 'atasan_id' => 2, 'required_to_submit_document' => "2;3;4"],
            ['role' => 'Dekan Fakultas Vokasi', 'status' => true, 'is_admin' => false, 'atasan_id' => 2, 'required_to_submit_document' => "2;3;4"],
            ['role' => 'Ketua Program Studi S1 Informatika', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => '3;4'],
            ['role' => 'Ketua Program Studi S1 Elektro', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => '3;4'],
            ['role' => 'Ketua Program Studi S1 Sistem Informasi', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => '3;4'],
            ['role' => 'Ketua Program Studi S1 Manajemen Rekayasa', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => '3;4'],
            ['role' => 'Ketua Program Studi S1 Teknik Metalurgi', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => '3;4'],
            ['role' => 'Ketua Program Studi S1 Teknik Bioproses', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => '3;4'],
            ['role' => 'Ketua Program Studi D3 Teknik Informasi', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => '3;4'],
            ['role' => 'Ketua Program Studi D3 Teknik Komputer', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => '3;4'],
            ['role' => 'Ketua Program Studi D4 Teknologi Rekayasa Perangkat Lunak', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => '3;4'],
            ['role' => 'Dosen Program Studi S1 Informatika', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Dosen Program Studi S1 Elektro', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Dosen Program Studi S1 Sistem Informasi', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Dosen Program Studi S1 Manajemen Rekayasa', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Dosen Program Studi S1 Teknik Metalurgi', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Dosen Program Studi S1 Teknik Bioproses', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Dosen Program Studi D3 Teknik Informasi', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Dosen Program Studi D3 Teknik Komputer', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
            ['role' => 'Dosen Program Studi D4 Teknologi Rekayasa Perangkat Lunak', 'status' => true, 'is_admin' => false, 'atasan_id' => null, 'required_to_submit_document' => null],
        ]);
    }
}
