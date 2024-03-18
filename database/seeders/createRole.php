<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class createRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role')->insert([
           ['role' => 'Rektor '],
           ['role' => 'Wakil Rektor 1 '],
           ['role' => 'Dekan'],
           ['role' => 'Ketua GJM'],
           ['role' => 'Anggota GJM'],
           ['role' => 'Member of BAA Fakultas'],
           ['role' => 'Ketua Program Studi'],
           ['role' => 'Ketua GKM'],
           ['role' => 'Anggota GKM'],
           ['role' => 'Direktur Pendidikan'],
           ['role' => 'Member of BAA Institut'],
           ['role' => 'Member of Lembaga Kemahasiswaan'],
           ['role' => 'Member of Pusat Pembinaan Keasramaan'],
           ['role' => 'Member of SDI'],
           ['role' => 'Member of Divisi Infrastruktur'],
           ['role' => 'Member of Keamanan dan QA'],
           ['role' => 'Member of PPKHA'],
           ['role' => 'Member of UPT PP ESTEM'],
           ['role' => 'Member of UPT SAM'],
           ['role' => 'Member of UPT Perpustakaan'],
           ['role' => 'Member of UPT Bahasa'],
           ['role' => 'Wakil Rektor 2'],
           ['role' => 'Member of Pusat Perencanaan'],
           ['role' => 'Member of PMM'],
           ['role' => 'Member of Logistik'],
           ['role' => 'Member of Keuangan'],
           ['role' => 'Member of Biro Administrasi Umum'],
           ['role' => 'Member of UPT Kantin'],
           ['role' => 'Wakil Rektor 3'],
           ['role' => 'Member of Kerjasama dan Humas'],
           ['role' => 'Member of Kantor Urusan Internasional'],
           ['role' => 'Member of Pusat Inovasi dan Kewirausahaan'],
           ['role' => 'Member of KHDTK'],
           ['role' => 'Ketua SPM'],
           ['role' => 'Staf SPM'],
           ['role' => 'Ketua SPI'],
           ['role' => 'Staf SPI'],
           ['role' => 'Ketua LPPM'],
           ['role' => 'Staf LPPM'],
           ['role' => 'Dosen S1TB'],
           ['role' => 'Dosen S1MR'],
           ['role' => 'Dosen S1TM'],
           ['role' => 'Dosen D3TI'],
           ['role' => 'Dosen D3TK'],
           ['role' => 'Dosen STTRPL'],
           ['role' => 'Dosen S1TE'],
           ['role' => 'Dosen S1IF'],
           ['role' => 'Dosen S1SI'],
           ['role' => 'Admin'],
        ]);
    }
}
