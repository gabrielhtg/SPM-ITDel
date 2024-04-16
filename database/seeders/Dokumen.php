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
        for ($i = 0; $i < 20; $i++) {
            // Pilih ID dokumen yang akan digantikan secara acak
            $replacementDocumentId = rand(1, $i);
            
            $documentData = [
                'name' => 'Dokumen ' . ($i + 1),
                'nama_dokumen' => 'dokumen_' . ($i + 1) . '.pdf',
                'nomor_dokumen' => 'DOC00' . ($i + 1),
                'deskripsi' => 'Deskripsi dokumen ' . ($i + 1),
                'directory' => '/src/documents/dokumen_' . ($i + 1) . '.pdf',
                'give_access_to' => '0;1;2;3',
                'give_edit_access_to' => '1;2;3',
                'created_by' => '1',
                'menggantikan_dokumen' => $replacementDocumentId,
                'year' => 2024,
                'tipe_dokumen' => '1',
                'parent'=>'1',
                'start_date' => Carbon::now()->format('Y-m-d H:i:s'),
                'end_date' => Carbon::now()->addDays(5)->format('Y-m-d H:i:s'), // 5 hari ke depan
                'keterangan_status' => true,
                'can_see_by' => true,
                'link' => null,
            ];

            DocumentModel::create($documentData);
        }

        for ($j = 0; $j < 15; $j++) {
            // Pilih ID dokumen yang akan digantikan secara acak
            $replacementDocumentId = rand(1, $j);
            
            $documentData = [
                'name' => 'dedi ' . ($j + 1),
                'nama_dokumen' => 'dokumen_' . ($j + 1) . '.pdf',
                'nomor_dokumen' => 'DOC00' . ($j + 2),
                'deskripsi' => 'Deskripsi dokumen ' . ($j + 1),
                'directory' => '/src/documents/dokumen_' . ($j + 1) . '.pdf',
                'give_access_to' => '0;1;2;3',
                'give_edit_access_to' => '1;2;3',
                'created_by' => '1',
                'menggantikan_dokumen' => $replacementDocumentId,
                'year' => 2024,
                'tipe_dokumen' => '1',
                'parent'=>'2',
                'start_date' => Carbon::now()->format('Y-m-d H:i:s'),
                'end_date' => Carbon::now()->addDays(5)->format('Y-m-d H:i:s'), // 5 hari ke depan
                'keterangan_status' => true,
                'can_see_by' => true,
                'link' => null,
            ];

            DocumentModel::create($documentData);
        }
    }
}
