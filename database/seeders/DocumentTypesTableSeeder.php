<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentTypesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('document_types')->insert([
            ['jenis_dokumen' => 'Peraturan Pemerintah'],
            ['jenis_dokumen' => 'Statuta IT Del'],
            ['jenis_dokumen' => 'Rencana Induk Pengembangan IT Del'],
            ['jenis_dokumen' => 'Rencana Strategis IT Del'],
            ['jenis_dokumen' => 'Rencana Operasional IT Del'],
            ['jenis_dokumen' => 'Kebijakan Rektor IT Del'],
            ['jenis_dokumen' => 'Kebijakan SPMI'],
            ['jenis_dokumen' => 'Standar SPMI'],
            ['jenis_dokumen' => 'Manual SPMI'],
            ['jenis_dokumen' => 'Formulir SPMI'],
            ['jenis_dokumen' => 'SOP'],
            ['jenis_dokumen' => 'Instruksi Kerja'],
            ['jenis_dokumen' => 'Artefak AMI'],
            ['jenis_dokumen' => 'Laporan RTM'],
            ['jenis_dokumen' => 'Laporan Evaluasi Kepuasan'],
            ['jenis_dokumen' => 'Laporan Berkala'],
            ['jenis_dokumen' => 'Rencana Strategis Fakultas'],
            ['jenis_dokumen' => 'Rencana Operasional Fakultas'],
            ['jenis_dokumen' => 'Kebijakan Dekan'],
            ['jenis_dokumen' => 'Dokumen Lainnya'],
        ]);
    }
}
