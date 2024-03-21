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
                'name' => 'Dokumen 1',
                'nama_dokumen' => 'dokumen_terlewat.pdf',
                'nomor_dokumen' => 'DOC001',
                'deskripsi' => 'Deskripsi dokumen terlewat',
                'directory' => '/src/documents/dokumen_terlewat.pdf',
                'give_access_to' => '1;2;3',
                'give_edit_access_to' => '1;2;3',
                'created_by' => '1',
                'menggantikan_dokumen' => null,
                'year' => 2024,
                'tipe_dokumen' => 1,
                'start_date' => Carbon::now()->subDays(5)->format('Y-m-d H:i:s'), // 5 hari sebelumnya
                'end_date' => Carbon::now()->subDays(2)->format('Y-m-d H:i:s'), // 2 hari sebelumnya
                'keterangan_status' => true,
                'can_see_by' => true,
                'link' => null,
            ],
            [
                'name' => 'dokumen 2',
                'nama_dokumen' => 'dokumen_mendatang.pdf',
                'nomor_dokumen' => 'DOC002',
                'deskripsi' => 'Deskripsi dokumen mendatang',
                'directory' => '/src/documents/dokumen_mendatang.pdf',
                'give_access_to' => '1;2;3',
                'give_edit_access_to' => '1;2;3',
                'created_by' => '1',
                
                'menggantikan_dokumen' => 1,
                'year' => 2024,
                'tipe_dokumen' => 1,
                'start_date' => Carbon::now()->format('Y-m-d H:i:s'),
                'end_date' => Carbon::now()->addDays(5)->format('Y-m-d H:i:s'), // 5 hari ke depan
                'keterangan_status' => true,
                'can_see_by' => true,
                'link' => null,
            ],
            [
                'name' => 'dokumen 2',
                'nama_dokumen' => 'dokumen_mendatang.pdf',
                'nomor_dokumen' => 'DOC003',
                'deskripsi' => 'Deskripsi dokumen mendatang',
                'directory' => '/src/documents/dokumen_mendatang.pdf',
                'give_access_to' => '1;2;3',
                'give_edit_access_to' => '1;2;3',
                'created_by' => '1',
                
                'menggantikan_dokumen' => 2,
                'year' => 2024,
                'tipe_dokumen' => 1,
                'start_date' => Carbon::now()->format('Y-m-d H:i:s'),
                'end_date' => Carbon::now()->addDays(5)->format('Y-m-d H:i:s'), // 5 hari ke depan
                'keterangan_status' => true,
                'can_see_by' => true,
                'link' => null,
            ],
            [
                'name' => 'dokumen 3',
                'nama_dokumen' => 'dokumen_mendatang.pdf',
                'nomor_dokumen' => 'DOC004',
                'deskripsi' => 'Deskripsi dokumen mendatang',
                'directory' => '/src/documents/dokumen_mendatang.pdf',
                'give_access_to' => '1;2;3',
                'give_edit_access_to' => '1;2;3',
                'created_by' => '1',
                
                'menggantikan_dokumen' => 3,
                'year' => 2024,
                'tipe_dokumen' => 1,
                'start_date' => Carbon::now()->format('Y-m-d H:i:s'),
                'end_date' => Carbon::now()->addDays(5)->format('Y-m-d H:i:s'), // 5 hari ke depan
                'keterangan_status' => true,
                'can_see_by' => true,
                'link' => null,
            ], [
                'name' => 'dokumen 4',
                'nama_dokumen' => 'dokumen_mendatang.pdf',
                'nomor_dokumen' => 'DOC005',
                'deskripsi' => 'Deskripsi dokumen mendatang',
                'directory' => '/src/documents/dokumen_mendatang.pdf',
                'give_access_to' => '1;2;3',
                'give_edit_access_to' => '1;2;3',
                'created_by' => '1',
                
                'menggantikan_dokumen' => 4,
                'year' => 2024,
                'tipe_dokumen' => 1,
                'start_date' => Carbon::now()->format('Y-m-d H:i:s'),
                'end_date' => Carbon::now()->addDays(5)->format('Y-m-d H:i:s'), // 5 hari ke depan
                'keterangan_status' => true,
                'can_see_by' => true,
                'link' => null,
            ],
            [
                'name' => 'dokumen 5',
                'nama_dokumen' => 'dokumen_mendatang.pdf',
                'nomor_dokumen' => 'DOC006',
                'deskripsi' => 'Deskripsi dokumen mendatang',
                'directory' => '/src/documents/dokumen_mendatang.pdf',
                'give_access_to' => '1;2;3',
                'give_edit_access_to' => '1;2;3',
                'created_by' => '1',
                
                'menggantikan_dokumen' => 5,
                'year' => 2024,
                'tipe_dokumen' => 1,
                'start_date' => Carbon::now()->format('Y-m-d H:i:s'),
                'end_date' => Carbon::now()->addDays(5)->format('Y-m-d H:i:s'), // 5 hari ke depan
                'keterangan_status' => true,
                'can_see_by' => true,
                'link' => null,
            ],
           
        ];

        foreach ($documents as $documentData) {
            DocumentModel::create($documentData);
        }
    }
}
