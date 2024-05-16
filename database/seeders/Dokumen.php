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
    public function run()
    {
        // Dokumen 1
        DocumentModel::create([
            'name' => 'Statuta Institut Teknologi Del 2019',
            'nama_dokumen' => 'Statuta-Institut-Teknologi-Del-2019.pdf',
            'nomor_dokumen' => '064/YD/SK/XI/2019',
            'deskripsi' => '<p>Statuta merupakan anggaran dasar bagi perguruan tinggi dalam melaksanakan Tridharma Perguruan Tinggi. Statuta dipakai sebagai acuan untuk merencanakan, mengembangkan program, dan menyelenggarakan kegiatan fungsional sesuai dengan tujuan perguruan tinggi.</p>',
            'directory' => '/src/documents/Statuta-Institut-Teknologi-Del-2019.pdf',
            'give_access_to' =>0,
            'give_edit_access_to' => 1,
            'created_by' => 1,
            // 'menggantikan_dokumen' => 'Dokumen Lama 1',
            'year' => 2019,
            'tipe_dokumen' => 2,
            'dokumen_spm' =>false,
            'set_date' => '2019-11-22 00:00:00',
            'start_date' => '2019-11-22 00:00:00',
            // 'end_date' => Carbon::now()->addDays(30), // Tambahkan 30 hari dari tanggal sekarang
            'keterangan_status' => true,
            'can_see_by' => true,
            // 'link' => 'http://example.com',
            // 'keterangan_berlaku' => true,
        ]);

        // Dokumen 2
    //     DocumentModel::create([
    //         'name' => 'Nama Dokumen 2',
    //         'nama_dokumen' => 'Nama Dokumen 2',
    //         'nomor_dokumen' => 'ND-002',
    //         'deskripsi' => 'Deskripsi Dokumen 2',
    //         'directory' => '/path/to/directory',
    //         'give_access_to' => 'User3',
    //         'give_edit_access_to' => 'User4',
    //         'created_by' => 2,
    //         'menggantikan_dokumen' => 'Dokumen Lama 2',
    //         'year' => 2024,
    //         'tipe_dokumen' => 'Tipe Dokumen 2',
    //         'dokumen_spm' => true,
    //         'set_date' => Carbon::now(),
    //         'start_date' => Carbon::now(),
    //         'end_date' => Carbon::now()->addDays(60), // Tambahkan 60 hari dari tanggal sekarang
    //         'keterangan_status' => true,
    //         'can_see_by' => true,
    //         'link' => 'http://example.com',
    //         'keterangan_berlaku' => true,
    //     ]);

    //     // Dokumen 3
    //     DocumentModel::create([
    //         'name' => 'Nama Dokumen 3',
    //         'nama_dokumen' => 'Nama Dokumen 3',
    //         'nomor_dokumen' => 'ND-003',
    //         'deskripsi' => 'Deskripsi Dokumen 3',
    //         'directory' => '/path/to/directory',
    //         'give_access_to' => 'User5',
    //         'give_edit_access_to' => 'User6',
    //         'created_by' => 3,
    //         'menggantikan_dokumen' => 'Dokumen Lama 3',
    //         'year' => 2024,
    //         'tipe_dokumen' => 'Tipe Dokumen 3',
    //         'dokumen_spm' => true,
    //         'set_date' => Carbon::now(),
    //         'start_date' => Carbon::now(),
    //         'end_date' => Carbon::now()->addDays(90), // Tambahkan 90 hari dari tanggal sekarang
    //         'keterangan_status' => true,
    //         'can_see_by' => true,
    //         'link' => 'http://example.com',
    //         'keterangan_berlaku' => true,
    //     ]);
    }
}
