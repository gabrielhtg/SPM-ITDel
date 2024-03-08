<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\DocumentModel;

class Dokumen extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documents = [
            [
                'name' => 'Dokumen Terlewat',
                'nama_dokumen' => 'dokumen_terlewat.pdf',
                'nomor_dokumen' => 'DOC001',
                'deskripsi' => 'Deskripsi dokumen terlewat',
                'directory' => '/src/documents/dokumen_terlewat.pdf',
                'give_access_to' => '1;2;3',
                'created_by' => '1',
                'status' => 'Berlaku',
                'menggantikan_dokumen' => null,
                'year' => 2024,
                'tipe_dokumen' => 'Rencana Induk Pengembangan IT Del',
                'start_date' => Carbon::now()->subDays(5)->format('Y-m-d H:i:s'), // 5 hari sebelumnya
                'end_date' => Carbon::now()->subDays(2)->format('Y-m-d H:i:s'), // 2 hari sebelumnya
                'keterangan_status' => 'Active',
                'can_see_by' => true,
                'link' => null,
            ],
            [
                'name' => 'Dokumen Mendatang',
                'nama_dokumen' => 'dokumen_mendatang.pdf',
                'nomor_dokumen' => 'DOC002',
                'deskripsi' => 'Deskripsi dokumen mendatang',
                'directory' => '/src/documents/dokumen_mendatang.pdf',
                'give_access_to' => '1;2;3',
                'created_by' => '1',
                'status' => 'Berlaku',
                'menggantikan_dokumen' => null,
                'year' => 2024,
                'tipe_dokumen' => 'Rencana Induk Pengembangan IT Del',
                'start_date' => Carbon::now()->format('Y-m-d H:i:s'),
                'end_date' => Carbon::now()->addDays(5)->format('Y-m-d H:i:s'), // 5 hari ke depan
                'keterangan_status' => 'Active',
                'can_see_by' => true,
                'link' => null,
            ],
           
        ];

        foreach ($documents as $documentData) {
            DocumentModel::create($documentData);
        }
    }
}
