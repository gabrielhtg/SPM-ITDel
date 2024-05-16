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
        DocumentModel::create([
            'name' => 'Rencana Strategis Periode 2018-2021 IT Del',
            'nama_dokumen' => 'Rencana-Strategis-Periode-2018-2021-IT-Del.pdf',
            'nomor_dokumen' => '115/ITDel/Rek/SK/IX/17',
            'deskripsi' => '<p>Perencanaan operasional meningkatkan efisiensi, produktivitas, dan keuntungan dengan memastikan anggota di setiap departemen dan di seluruh perusahaan mengetahui tanggung jawab dan tujuan mereka sehari-hari.</p>',
            'directory' => '/src/documents/Rencana-Strategis-Periode-2018-2021-IT-Del.pdf',
            'give_access_to' =>0,
            'give_edit_access_to' => 1,
            'created_by' => 1,
            // 'menggantikan_dokumen' => 'Dokumen Lama 1',
            'year' => 2017,
            'tipe_dokumen' => 5,
            'dokumen_spm' =>false,
            'set_date' => '2018-08-22 00:00:00',
            'start_date' => '2018-08-22 00:00:00',
            // 'end_date' => Carbon::now()->addDays(30), // Tambahkan 30 hari dari tanggal sekarang
            'keterangan_status' => true,
            'can_see_by' => true,
            // 'link' => 'http://example.com',
            // 'keterangan_berlaku' => true,
        ]);

    //     // Dokumen 3
        DocumentModel::create([
            'name' => 'Rek SK Renstra IT Del 2020 2024',
            'nama_dokumen' => '028_Rek_SK_Renstra-IT-Del-2020-2024-beserta-lampiran.pdf',
            'nomor_dokumen' => '028/ITDel/Rek/SK/Rens/III/21',
            'deskripsi' => '<p>Buku Rencana Strategis ini merupakan “rencana
            dinamis” yang senantiasa dapat diperbaiki,
            diperbaharui, dan dimutakhirkan sesuai dengan
            dinamika kebutuhan dan perubahan zaman.</p>',
            'directory' => '/src/documents/028_Rek_SK_Renstra-IT-Del-2020-2024-beserta-lampiran.pdf',
            'give_access_to' =>0,
            'give_edit_access_to' => 1,
            'created_by' => 1,
            // 'menggantikan_dokumen' => 'Dokumen Lama 1',
            'year' => 2021,
            'tipe_dokumen' => 4,
            'dokumen_spm' =>false,
            'set_date' => '2020-08-22 00:00:00',
            'start_date' => '2020-08-22 00:00:00',
            // 'end_date' => Carbon::now()->addDays(30), // Tambahkan 30 hari dari tanggal sekarang
            'keterangan_status' => true,
            'can_see_by' => true,
            // 'link' => 'http://example.com',
            // 'keterangan_berlaku' => true,
        ]);

        DocumentModel::create([
            'name' => 'Surat Keputusan Wakil Rektor Bidang Akademik dan Kemahasiswaan IT Del',
            'nama_dokumen' => '052_SK_end-to-end.pdf',
            'nomor_dokumen' => '052/ITDel/WR/SK/IX/17',
            'deskripsi' => '<p>Ketentuan pelaksanaan kegiatan akademik</p>',
            'directory' => '/src/documents/052_SK_end-to-end.pdf',
            'give_access_to' =>0,
            'give_edit_access_to' => 1,
            'created_by' => 1,
            // 'menggantikan_dokumen' => 'Dokumen Lama 1',
            'year' => 2017,
            'tipe_dokumen' => 6,
            'dokumen_spm' =>false,
            'set_date' => '2017-08-22 00:00:00',
            'start_date' => '2017-08-22 00:00:00',
            // 'end_date' => Carbon::now()->addDays(30), // Tambahkan 30 hari dari tanggal sekarang
            'keterangan_status' => true,
            'can_see_by' => true,
            // 'link' => 'http://example.com',
            // 'keterangan_berlaku' => true,
        ]);

        DocumentModel::create([
            'name' => 'Kebijakan Penyusunan Kurikulum Pendidikan IT Del',
            'nama_dokumen' => 'Surat-Keputusan-Senat-Akademik-IT-Del-Tentang-Kebijakan-Penyusunan-Kurikulum-Pendidikan-IT-Del-Tahun-2014-2019-Nomor-001ITDELSASKKURVIII2014.pdf',
            'nomor_dokumen' => '001/IT DEL/SA/SK/KUR/IX/14',
            'deskripsi' => '<p>Perubahan bentuk Politeknik Informatika Del menjadi Institut Teknologi Del, perlu untuk mengatur ketentuan mengenai kurikulum pendidikan</p>',
            'directory' => '/src/documents/Surat-Keputusan-Senat-Akademik-IT-Del-Tentang-Kebijakan-Penyusunan-Kurikulum-Pendidikan-IT-Del-Tahun-2014-2019-Nomor-001ITDELSASKKURVIII2014.pdf',
            'give_access_to' =>0,
            'give_edit_access_to' => 1,
            'created_by' => 1,
            // 'menggantikan_dokumen' => 'Dokumen Lama 1',
            'year' => 2014,
            'tipe_dokumen' => 20,
            'dokumen_spm' =>false,
            'set_date' => '2014-08-22 00:00:00',
            'start_date' => '2014-08-22 00:00:00',
            // 'end_date' => Carbon::now()->addDays(30), // Tambahkan 30 hari dari tanggal sekarang
            'keterangan_status' => true,
            'can_see_by' => true,
            // 'link' => 'http://example.com',
            // 'keterangan_berlaku' => true,
        ]);

        DocumentModel::create([
            'name' => 'Pengesahan Kurikulum 2014-2019 Program Studi di Lingkungan IT Del',
            'nama_dokumen' => 'Surat-Keputusan-Senat-Akademik-IT-Del-Tentang-Pengesahan-Kurikulum-Pendidikan-2014-2019-Program-Studi-Dilingkungan-IT-Del-Nomor-002ITDELSASKKUR.pdf',
            'nomor_dokumen' => '002/IT DEL/SA/SK/KUR/IX/14',
            'deskripsi' => '<p>Mengesahkan berlakunya kurikulum 2014-2019 bagi setiap program studi</p>',
            'directory' => '/src/documents/Surat-Keputusan-Senat-Akademik-IT-Del-Tentang-Pengesahan-Kurikulum-Pendidikan-2014-2019-Program-Studi-Dilingkungan-IT-Del-Nomor-002ITDELSASKKUR.pdf',
            'give_access_to' =>0,
            'give_edit_access_to' => 1,
            'created_by' => 1,
            // 'menggantikan_dokumen' => 'Dokumen Lama 1',
            'year' => 2014,
            'tipe_dokumen' => 20,
            'dokumen_spm' =>false,
            'set_date' => '2014-08-22 00:00:00',
            'start_date' => '2014-08-22 00:00:00',
            // 'end_date' => Carbon::now()->addDays(30), // Tambahkan 30 hari dari tanggal sekarang
            'keterangan_status' => true,
            'can_see_by' => true,
            // 'link' => 'http://example.com',
            // 'keterangan_berlaku' => true,
        ]);


        DocumentModel::create([
            'name' => 'Kode Etik Dosen',
            'nama_dokumen' => 'SK-Senat-Akademik-IT-Del-No.-014.1-Tentang-Kode-Etik-Dosen-IT-Del.pdf',
            'nomor_dokumen' => '014.1/ITD/REK/SK/SDM//IV/14',
            'deskripsi' => '<p>Perubahan bentuk Politeknik Informatika Del menjadi Institut Teknologi Del, perlu untuk mengatur kode etik dosen</p>',
            'directory' => '/src/documents/SK-Senat-Akademik-IT-Del-No.-014.1-Tentang-Kode-Etik-Dosen-IT-Del.pdf',
            'give_access_to' =>0,
            'give_edit_access_to' => 1,
            'created_by' => 1,
            // 'menggantikan_dokumen' => 'Dokumen Lama 1',
            'year' => 2014,
            'tipe_dokumen' => 20,
            'dokumen_spm' =>false,
            'set_date' => '2014-08-22 00:00:00',
            'start_date' => '2014-08-22 00:00:00',
            // 'end_date' => Carbon::now()->addDays(30), // Tambahkan 30 hari dari tanggal sekarang
            'keterangan_status' => true,
            'can_see_by' => true,
            // 'link' => 'http://example.com',
            // 'keterangan_berlaku' => true,
        ]);

        DocumentModel::create([
            'name' => 'Kode Etik Tenaga Kependidikan IT Del',
            'nama_dokumen' => 'SK-Senat-Akademik-IT-Del-No.-014.2-Tentang-Kode-Etik-Tenaga-Kependidikan-IT-Del.pdf',
            'nomor_dokumen' => '014.2/ITD/REK/SK/SDM//IV/14',
            'deskripsi' => '<p>Perubahan bentuk Politeknik Informatika Del menjadi Institut Teknologi Del, perlu untuk mengatur kode etik tenaga kependidikan Institut Teknologi Del</p>',
            'directory' => '/src/documents/SK-Senat-Akademik-IT-Del-No.-014.2-Tentang-Kode-Etik-Tenaga-Kependidikan-IT-Del.pdf',
            'give_access_to' =>0,
            'give_edit_access_to' => 1,
            'created_by' => 1,
            // 'menggantikan_dokumen' => 'Dokumen Lama 1',
            'year' => 2014,
            'tipe_dokumen' => 20,
            'dokumen_spm' =>false,
            'set_date' => '2014-08-22 00:00:00',
            'start_date' => '2014-08-22 00:00:00',
            // 'end_date' => Carbon::now()->addDays(30), // Tambahkan 30 hari dari tanggal sekarang
            'keterangan_status' => true,
            'can_see_by' => true,
            // 'link' => 'http://example.com',
            // 'keterangan_berlaku' => true,
        ]);

        DocumentModel::create([
            'name' => 'Kebijakan Pengembangan Suasana Akademik IT Del',
            'nama_dokumen' => 'SK-Senat-Akademik-IT-Del-No.-001-Tentang-Kebijakan-Pengembangan-Suasana-Akademik-IT-Del.compressed.pdf',
            'nomor_dokumen' => '001/IT DEL/SA/SK/ADM/II/15',
            'deskripsi' => '<p>Bahwa berdasarkan Statuta Institut Teknologi Del, dalam Senat Akademik bertugas menetapkan pola-laku dan adat kebiasaan sivitas akademika untuk mendukung pengembangan suasana akademik (academic atmosphere) yang kondusif dalam menunjang perilaku dan produktivitas kecendekiawan</p>',
            'directory' => '/src/documents/SK-Senat-Akademik-IT-Del-No.-001-Tentang-Kebijakan-Pengembangan-Suasana-Akademik-IT-Del.compressed.pdf',
            'give_access_to' =>0,
            'give_edit_access_to' => 1,
            'created_by' => 1,
            // 'menggantikan_dokumen' => 'Dokumen Lama 1',
            'year' => 2015,
            'tipe_dokumen' => 20,
            'dokumen_spm' =>false,
            'set_date' => '2015-08-22 00:00:00',
            'start_date' => '2015-08-22 00:00:00',
            // 'end_date' => Carbon::now()->addDays(30), // Tambahkan 30 hari dari tanggal sekarang
            'keterangan_status' => true,
            'can_see_by' => true,
            // 'link' => 'http://example.com',
            // 'keterangan_berlaku' => true,
        ]);

        DocumentModel::create([
            'name' => 'Tata Cara Pemberian dan Pencabutan Gelar dan Ijazah IT Del',
            'nama_dokumen' => 'SK-Senat-Akademik-IT-Del-No.-003-Tentang-Tata-Cara-Penarikan-Gelar-dan-Ijazah-IT-Del.pdf',
            'nomor_dokumen' => '003/IT DEL/SA/SK/ADM/II/15',
            'deskripsi' => '<p>Senat Akademik bertugas antara lain mengatur ketentuan mengenai tata cara pemberian dan pencabutan gelar dan ijazah di Institut Teknologi Del, Statuta Institut Teknologi Del menetapkan tugas pimpinan Institut antara lain menganugerahkan ijazah, diperlukan ketentuan tentang tanda pengesahan dari pejabat Institut Teknologi Del yang berwenang</p>',
            'directory' => '/src/documents/SK-Senat-Akademik-IT-Del-No.-003-Tentang-Tata-Cara-Penarikan-Gelar-dan-Ijazah-IT-Del.pdf',
            'give_access_to' =>0,
            'give_edit_access_to' => 1,
            'created_by' => 1,
            // 'menggantikan_dokumen' => 'Dokumen Lama 1',
            'year' => 2015,
            'tipe_dokumen' => 20,
            'dokumen_spm' =>false,
            'set_date' => '2015-08-22 00:00:00',
            'start_date' => '2015-08-22 00:00:00',
            // 'end_date' => Carbon::now()->addDays(30), // Tambahkan 30 hari dari tanggal sekarang
            'keterangan_status' => true,
            'can_see_by' => true,
            // 'link' => 'http://example.com',
            // 'keterangan_berlaku' => true,
        ]);

        DocumentModel::create([
            'name' => 'Pedoman Untuk Pemberian Penghargaan IT Del',
            'nama_dokumen' => 'Surat-Keputusan-Senat-Akademik-IT-Del-TentangPedoman-Untuk-Pemberian-Penghargaan-IT-Del-Nomor-004ITDELSASKKURII2015.pdf',
            'nomor_dokumen' => '004/IT DEL/SA/SK/ADM/II/15',
            'deskripsi' => '<p>bahwa berdasarkan ketentuan pada Pasal 21 Ayat (1) Statuta Institut Teknologi Del, penghargaan disampaikan kepada anggota masyarakat sebagai pengakuan dan apresiasi atas prestasi, jasa, dan pengabdian yang luar biasa kepada institut dan atau kontribusi yang luar biasa pada kemajuan ilmu pengetahuan, teknologi, kesenian, dan ilmu sosial kemanusiaan, bahwa Sidang Senat Akademik tanggal 16 Februari 2015 telah mensahkan Pedoman Untuk Pemberian Penghargaan Institut Teknologi Del, bahwa sebagai tindak lanjut butir "a dan b" di atas perlu penerbitan Surat Keputusan Senat Akademik.</p>',
            'directory' => '/src/documents/Surat-Keputusan-Senat-Akademik-IT-Del-TentangPedoman-Untuk-Pemberian-Penghargaan-IT-Del-Nomor-004ITDELSASKKURII2015.pdf',
            'give_access_to' =>0,
            'give_edit_access_to' => 1,
            'created_by' => 1,
            // 'menggantikan_dokumen' => 'Dokumen Lama 1',
            'year' => 2015,
            'tipe_dokumen' => 20,
            'dokumen_spm' =>false,
            'set_date' => '2015-08-22 00:00:00',
            'start_date' => '2015-08-22 00:00:00',
            // 'end_date' => Carbon::now()->addDays(30), // Tambahkan 30 hari dari tanggal sekarang
            'keterangan_status' => true,
            'can_see_by' => true,
            // 'link' => 'http://example.com',
            // 'keterangan_berlaku' => true,
        ]);
    }
}
