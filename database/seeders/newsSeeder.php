<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('news')->insert([
            [
                'title' => "Mahasiswa Teknik Elektro IT Del Berhasil Meraih Medali Emas Pada IDEA FEST 2024 Kategori Teknologi Pertanian",
                'description' => "IDEA FEST 2024 merupakan kompetisi inovasi teknologi yang diselenggarakan oleh Sentosa Foundation bekerjasama dengan Universitas Gunung Rinjani. Kompetisi ini mengusung tema “Peran Inovator Muda Dalam Menghadapi Persaingan Global 2045”",
                'bgimage' => "../gambarnews/news1.jpg",
                'created_at' => now(),
            ],
            [
                'title' => "Institut Teknologi Del Jalin Kerjasama dengan Hidrokinetik Technologies Sdn. Bhd. Terkait Tri Dharma Perguruan Tinggi",
                'description' => "Institut Teknologi Del menginisiasi kerja sama riset dan pengembangan dalam eksplorasi aspek Geophysical dan Geotechnical (G&G) Kawasan Danau Toba (KDT), dengan perusahaan teknologi multinasional di bidang survey dan pemetaan kebumian",
                'bgimage' => "../gambarnews/news2.jpg",
                'created_at' => now(),
            ],
            [
                'title' => "Pembekalan Mahasiswa Kerja Praktik Prodi Teknik Bioproses",
                'description' => "Program Studi S1 Teknik Bioproses (TB) IT Del mengadakan kuliah umum pembekalan Kerja Praktik (KP) pada hari Rabu, 6 Maret 2024. Pemateri pada sesi ini adalah Fenni R. Turnip, alumni",
                'bgimage' => "../gambarnews/news3.jpg",
                'created_at' => now(),
            ],
            [
                'title' => "Sosialisasi Pedoman dan Panduan yang Berlaku di LPPM Tahun 2024",
                'description' => "Pada tanggal 28 Februari 2024, LPPM Institut Teknologi Del menyelenggarakan kegiatan sosialisasi pedoman dan panduan yang berlaku di LPPM tahun 2024 kepada Bapak/Ibu Dosen IT Del",
                'bgimage' => "../gambarnews/news4.jpg",
                'created_at' => now(),
            ],
            [
                'title' => "Sharing Session terkait Program Pembinaan Mahasiswa Wirausaha (P2MW)",
                'description' => "Pada hari Jumat, 23 Februari 2024 dilakukan sharing session terkait kegiatan Program Pembinaan Mahasiswa Wirausaha (P2MW). Kegiatan ini dilaksanakan oleh mahasiswa yang berhasil menang pada P2MW 2023 dan  mengikuti kegiatan KMI Expo 2023 beserta dosen Kordinator kegiatan P2MW, Bapak Wesly Siagian.",
                'bgimage' => "../gambarnews/news5.jpg",
                'created_at' => now(),
            ],
            [
                'title' => "Penandatanganan MoU dan PKS antara IT Del dan PT Dimensi Kreasi Nusantara terkait Program Magang Mahasiswa",
                'description' => "Pada Hari Rabu, 28 Februari 2024 dilakukan penandatanganan Nota Kesepahaman mengenai Tridharma Perguruan Tinggi sekaligus Perjanjian Kerjasama mengenai pelaksanaan program magang MBKM antara Institut Teknologi Del dan PT Dimensi Kreasi Nusantara",
                'bgimage' => "../gambarnews/news6.jpg",
                'created_at' => now(),
            ]
        ]);
    }
}