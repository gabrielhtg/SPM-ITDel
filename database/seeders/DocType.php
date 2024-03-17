<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocType extends Seeder
{
    public function run(): void
    {
        DB::table('document_types')->insert([
            ['jenis_dokumen' => 'Peraturan Pemerintah', 'singkatan' => 'PP'],
            ['jenis_dokumen' => 'Statuta IT Del', 'singkatan' => 'Statuta'],
            ['jenis_dokumen' => 'Rencana Induk Pengembangan IT Del', 'singkatan' => 'RIP'],
            ['jenis_dokumen' => 'Rencana Strategis IT Del', 'singkatan' => 'RS'],
            ['jenis_dokumen' => 'Rencana Operasional IT Del', 'singkatan' => 'RO'],
            ['jenis_dokumen' => 'Kebijakan Rektor IT Del', 'singkatan' => 'KR'],
            ['jenis_dokumen' => 'Kebijakan SPMI', 'singkatan' => 'KS'],
            ['jenis_dokumen' => 'Standar SPMI', 'singkatan' => 'SS'],
            ['jenis_dokumen' => 'Manual SPMI', 'singkatan' => 'MS'],
            ['jenis_dokumen' => 'Formulir SPMI', 'singkatan' => 'FS'],
            ['jenis_dokumen' => 'SOP', 'singkatan' => 'SOP'],
            ['jenis_dokumen' => 'Instruksi Kerja', 'singkatan' => 'IK'],
            ['jenis_dokumen' => 'Artefak AMI', 'singkatan' => 'Artefak'],
            ['jenis_dokumen' => 'Laporan RTM', 'singkatan' => 'RTM'],
            ['jenis_dokumen' => 'Laporan Evaluasi Kepuasan', 'singkatan' => 'LEK'],
            ['jenis_dokumen' => 'Laporan Berkala', 'singkatan' => 'LB'],
            ['jenis_dokumen' => 'Rencana Strategis Fakultas', 'singkatan' => 'RSF'],
            ['jenis_dokumen' => 'Rencana Operasional Fakultas', 'singkatan' => 'ROF'],
            ['jenis_dokumen' => 'Kebijakan Dekan', 'singkatan' => 'KD'],
            ['jenis_dokumen' => 'Dokumen Lainnya', 'singkatan' => 'DLL'],
        ]);
    }
}
