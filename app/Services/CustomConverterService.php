<?php

namespace App\Services;

class CustomConverterService
{
    public function convertRole ($role) {
        switch ($role) {
            case 1:
                return 'Rektor';
            case 2:
                return 'Wakil Rektor';
            case 3:
                return 'Dekan';
            case 4:
                return 'Ketua KJM';
            case 5:
                return 'Anggota GJM';
            case 6:
                return 'Member of BAA Fakultas';
            case 7:
                return 'Ketua Program Studi';
            case 8:
                return 'Ketua GKM';
            case 9:
                return 'Anggota GKM';
            case 10:
                return 'Direktur Pendidikan';
            case 11:
                return 'Member of BAA Institut';
            case 12:
                return 'Member of Lembaga Kemahasiswaan';
            case 13:
                return 'Member of Pusat Pembinaan Keasramaan';
            case 14:
                return 'Member of SDI';
            case 15:
                return 'Member of Divisi Infrastruktur';
            case 16:
                return 'Member of Keamanan dan QA';
            case 17:
                return 'Member of PPKHA';
            case 18:
                return 'Member of UPT PP ESTEM';
            case 19:
                return 'Member of UPT SAM';
            case 20:
                return 'Member of UPT Perpustakaan';
            case 21:
                return 'Member of UPT Bahasa';
            case 22:
                return 'Wakil Rektor 2';
            case 23:
                return 'Member of Pusat Perencanaan';
            case 24:
                return 'Member of PMM';
            case 25:
                return 'Member of Logistik';
            case 26:
                return 'Member of Keuangan';
            case 27:
                return 'Member of Biro Administrasi Umum';
            case 28:
                return 'Member of UPT Kantin';
            case 29:
                return 'Wakil Rektor 3';
            case 30:
                return 'Member of Kerjasama dan Humas';
            case 31:
                return 'Member of Kantor Urusan Internasional';
            case 32:
                return 'Member of Pusat Inovasi dan Kewirausahaan';
            case 33:
                return 'Member of KHDTK';
            case 34:
                return 'Ketua SPM';
            case 35:
                return 'Staf SPM';
            case 36:
                return 'Ketua SPI';
            case 37:
                return 'Staf SPI';
            case 38:
                return 'Ketua LPPM';
            case 39:
                return 'Staf LPPM';
            default:
                return 'Unknown Role';
        }
    }
}
