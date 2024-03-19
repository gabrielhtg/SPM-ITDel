<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class create_dashboard_introduction extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dashboard')->insert([
            'juduldashboard' => 'Tentang IT DEL',
            'keterangandashboard' => '
                Sesuai arahan dari Direktorat Jenderal Pendidikan Tinggi tentang penjaminan mutu perguruan tinggi yang terdiri atas penjaminan mutu internal dan penjaminan mutu eksternal, maka Institut Teknologi Del 
                sebagai institusi pendidikan yang hendak menghasilkan sumber daya manusia dengan kompetensi yang baik harus mewujudkan arahan tersebut. Untuk itu dibentuklah AMI IT Del, pada tanggal 14 November 2008.  
                Saat ini, AMI sebagai lmebaga penjaminan mutu internal di IT Del sedang membangun fondasi dan mempersiapkan seluruh elemen yang dibutuhkan agar penjaminan mutu internal dapat dilaksanakan.

                Visi AMI IT Del
                Menjadi rujukan penjaminan mutu pendidikan tinggi, baik untuk aspek pendidikan, penelitian, pengabdian masyarakat, dan managemen kelembagaan perguruan tinggi. 
                
                Misi AMI IT Del
                Marroha, menjadikan mutu sebagai ruh yang menjiwai program dan kegiatan yang diselenggarakan oleh unit kerja dan insan Institut Teknologi Del di semua Satuan Akademik dan Satuan Unit mencapai karya yang bermutu dan akuntabel.
            ',
        ]);
        DB::table('hero_dashboard')->insert([
            'judulhero' => 'SPM IT DEL',
            'tambahanhero' => 'Ini Merupakan Website SPM IT DEL',
            'gambarhero' => '../walpeper/header_admisi.jpg',
        ]);
    }
}
