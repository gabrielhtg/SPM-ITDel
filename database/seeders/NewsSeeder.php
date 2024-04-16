<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('news')->insert([
            [
                'title' => "Del Debate Championship (DDC) 2024",
                'description' => "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\"><html><body><p>Mahasiswa Institut Teknologi Del yang aktif dalam Del English Club (DEC) disupervisi oleh UPT Bahasa IT Del mengadakan kompetisi debat dalam bahasa Inggris Del Debate Championship (DDC) 2024. Kompetisi ini dilaksanakan selama tiga hari, yaitu pada setiap hari Sabtu berturut pada tanggal 2 dan 9 Maret 2024 sebagai Preliminary Round, serta pada 16 Maret 2024 sebagai Final Round di gedung Auditorium IT Del. Dua orang Dosen IT Del, yaitu Monalisa Pasaribu, S.S., M.Ed (TESOL) dan Guntur Petrus Boy Knight, S.T., M.T. menjadi tim juri dalam sesi final.</p><p><img data-filename=\" \" style=\"width: 100%;\" src=\"/src/newsimg/ni1-1.png\"></p><p>Kompetisi debat ini diadakan dengan mengikuti aturan sistem British Parliamentary. Dalam kompetisi ini terdapat 8 tim dari setiap program studi (prodi) yang terdiri atas 2 orang Debaters dan 1 orang N1 sehingga secara total ada 24 orang peserta. Kompetisi ini memiliki 3 kategori pemenang, yaitu Best Debater yang dimenangkan oleh Kevin Samosir dan Jusas Tampubolon dari Prodi Sarjana Sistem Informasi, Best Speaker dimenangkan oleh Boas Manurung dari Prodi Sarjana Terapan Rekayasa Perangkat Lunak, serta Best N1 dimenangkan oleh Guntur Sinaga dari Prodi Sarjana Informatika.</p></body></html>",
                'bgimage' => "../gambarnews/bg1.png",
                'start_date' => Carbon::now()->format('Y-m-d H:i:s'),
                'end_date' => Carbon::now()->addDays(5)->format('Y-m-d H:i:s'),
                'keterangan_status' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],    
            [
                'title' => "Pelatihan Metagenomics Analysis from Environmental Samples using Oxford Nanopore Technologies",
                'description' => "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\"><html><body><p>Pada tanggal 22 dan 23 Maret 2024, dilaksanakan Pelatihan Metagenomics Analysis from Environmental Samples using Oxford Nanopore Technologies yang diadakan di Laboratorium Genetika dan Biomolekular Fakultas Bioteknologi IT Del yang berkoordinasi langsung dengan Fakultas Bioteknologi IT Del.</p><p><img data-filename=\" \" style=\"width: 100%;\" src=\"/src/newsimg/ni2-1.png\"></p><p>Kegiatan ini merupakan tindak lanjut kerja sama antara IT Del dan Yayasan Satriabudi Dharma Setia terkait akselerasi genomik Indonesia. Peserta training berasal dari 3 mahasiswa FITE yang sedang mengikuti short course bioinformatics dari YSDS dan 26 mahasiswa Teknik Bioproses yang sedang mengambil mata kuliah Praktikum Genetika dan Biomolekular. Kegiatan ini juga turut dihadiri oleh dr. Vincent selaku Ketua Yayasan Satriabudi Dharma Setia, staf YSDS, dosen dan staff dari Prodi Teknik Bioproses IT Del, dan Staf Peneliti dari KHDTK IT Del.</p></body></html>",
                'bgimage' => "../gambarnews/bg2.png",
                'start_date' => Carbon::now()->format('Y-m-d H:i:s'),
                'end_date' => Carbon::now()->addDays(5)->format('Y-m-d H:i:s'),
                'keterangan_status' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],        
            [
                'title' => "Mahasiswa Teknik Elektro IT Del Berhasil Meraih Medali Emas Pada IDEA FEST 2024 Kategori Teknologi Pertanian",
                'description' => "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\"><html><body><p>IDEA FEST 2024 merupakan kompetisi inovasi teknologi yang diselenggarakan oleh Sentosa Foundation bekerjasama dengan Universitas Gunung Rinjani. Kompetisi ini mengusung tema “Peran Inovator Muda Dalam Menghadapi Persaingan Global 2045” yang berlangsung mulai dari 13 Desember 2023-10 Maret 2024. Selamat kepada TIM FARMLAND ROVER IT Del</p><p><img data-filename=\" \" style=\"width: 100%;\" src=\"/src/newsimg/ni3-1.png\"></p><p>Setelah babak Final yang dilaksanakan pada tanggal 9 Maret 2024 di  Mataram, TIM FARMLAND ROVER IT Del  berhasil meraih medali emas untuk kategori teknologi pertanian.</p></body></html>",
                'bgimage' => "../gambarnews/bg3.png",
                'start_date' => Carbon::now()->format('Y-m-d H:i:s'),
                'end_date' => Carbon::now()->addDays(5)->format('Y-m-d H:i:s'),
                'keterangan_status' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => "Institut Teknologi Del Jalin Kerjasama dengan Hidrokinetik Technologies Sdn. Bhd. Terkait Tri Dharma Perguruan Tinggi",
                'description' => "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\"><html><body><p>Institut Teknologi Del menginisiasi kerja sama riset dan pengembangan dalam eksplorasi aspek Geophysical dan Geotechnical (G&G) Kawasan Danau Toba (KDT), dengan perusahaan teknologi multinasional di bidang survey dan pemetaan kebumian yang berbasis di Kuala Lumpur, Malaysia. Kerja sama riset ini didesain dengan objektif untuk melakukan survey dan pemetaan Kawasan Danau Toba, berbasiskan teknologi termutakhir, yaitu ocean & subsea robotic dan artificial intelligence. Sebagai langkah awal kerja sama, dilakukan penandatanganan MOU (Memorandum of Understanding) di Kampus Institut Teknologi Del, Laguboti, Kabupaten Toba, Sumatera Utara, pada 9 Maret 2024. Hadir dalam acara tersebut, Rektor IT Del, Dr. Arnaldo Sinaga, Wakil Rektor I, Dr. Johannes Sianipar, Wakil Rektor III, Humasak Simanjuntak, Dekan Fakultas Informatika dan Teknik Elektro, Indra Tambunan, Ph.D., beserta tim dari Hidrokinetik Technologies Sdn. Bhd. (HTSB) dari Kuala Lumpur dan Jakarta.</p><p><img data-filename=\" \" style=\"width: 100%;\" src=\"/src/newsimg/ni4-1.png\"></p><p>Pada kesempatan itu, Mirza Hamza, Chief Technical Officer (CTO) dari Hidrokinetik, menyampaikan pentingnya sebuah kolaborasi intens dan menyeluruh antara dunia industri dan dunia akademik dalam menghasilkan pengembangan teknologi yang dapat bermanfaat bagi kehidupan manusia, dan juga memiliki nilai dari sisi komersial. “Belajar dari success story (keberhasilan) dari yang telah kami lakukan selama 7 tahun terakhir bekerja sama dengan beberapa universitas di Malaysia untuk pengembangan teknologi ocean & subsea robotic dan artificial intelligence (AI), kami melihat Indonesia sebagai negara kepulauan terbesar di dunia, memiliki potensi yang sangat besar untuk di-explore dan ditekuni bersama. Terlebih lagi, IT Del selaku perguruan tinggi teknologi yang secara geografis terletak di tepi danau vulkanis terbesar di dunia, memiliki Danau Toba sebagai ‘laboratorium’ yang sangat besar untuk pengembangan teknologi eksplorasi kemaritiman ini”, ujar Mirza di sela-sela pertemuan penandatanganan MOU ini. Dr. Arnaldo juga menimpali bahwa kerja sama seperti ini tentu sangat bermanfaat bukan hanya untuk kepentingan dunia industri dan akademisi saja, namun juga membantu memberikan generasi muda yang merupakan fresh graduate, untuk mendapatkan pengalaman berharga yang bermanfaat untuk pengembangan karier setelah lulus dari perguruan tinggi.</p></body></html>",
                'bgimage' => "../gambarnews/bg4.png",
                'start_date' => Carbon::now()->format('Y-m-d H:i:s'),
                'end_date' => Carbon::now()->addDays(5)->format('Y-m-d H:i:s'),
                'keterangan_status' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => "Pembekalan Mahasiswa Kerja Praktik Prodi Teknik Bioproses",
                'description' => "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\"><html><body><p>Program Studi S1 Teknik Bioproses (TB) IT Del mengadakan kuliah umum pembekalan Kerja Praktik (KP) pada hari Rabu, 6 Maret 2024. Pemateri pada sesi ini adalah Fenni R. Turnip, alumni Prodi TB Angkatan 2016. Fenni saat ini berkarir sebagai R&D (Research and Development) Specialist di PT Jobubu Jarum Minahasa, yang bergerak di industri alkohol.</p><p><img data-filename=\" \" style=\"width: 100%;\" src=\"/src/newsimg/ni5-1.png\"></p><p>Fenni menjelaskan manfaat KP untuk mahasiswa TB dalam pengembangan dan pengaplikasian skill dan pengetahuan mereka untuk pemecahan masalah yang ditemukan dalam industri. Fenni menekankan bahwa skill dan pengetahuan yang didapat dari kampus melalui matakuliah yang diajarkan di Prodi TB sangat berhubungan dengan dunia industri. Contohnya, dari matakuliah Perancangan Pabrik, Fenni mampu mendesain suatu proses produksi dari awal sampai akhir. Di akhir materinya, Fenni menyampaikan bahwa lulusan Teknik Bioproses memiliki banyak peluang seperti di bidang optimasi fermentasi, mendesain bioreaktor, scale- up proses dan Quality Control, efisiensi energi, pengembangan produk baru, dan yang lainnya.</p></body></html>",
                'bgimage' => "../gambarnews/bg5.png",
                'start_date' => Carbon::now()->format('Y-m-d H:i:s'),
                'end_date' => Carbon::now()->addDays(5)->format('Y-m-d H:i:s'),
                'keterangan_status' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => "Sosialisasi Pedoman dan Panduan yang Berlaku di LPPM Tahun 2024",
                'description' => "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\"><html><body><p>Pada tanggal 28 Februari 2024, LPPM Institut Teknologi Del menyelenggarakan kegiatan sosialisasi pedoman dan panduan yang berlaku di LPPM tahun 2024 kepada Bapak/Ibu Dosen IT Del. Bapak Humasak Simanjuntak, selaku Pelaksana Tugas Ketua LPPM IT Del memaparkan Panduan Pelaksanaan Penelitian dan Pengabdian kepada Masyarakat Internal Tahun 2024. Kegiatan penelitian memiliki dua skema pendanaan yaitu Penelitian Dosen pemula dan Penelitian Dasar Unggulan Perguruan Tinggi. Dan untuk kegiatan Pengabdian Kepada Masyarakat juga memiliki dua skema yaitu Program Kemitraan Masyarakat dan Program Tanggung Jawab Sosial Institusi. Beliau juga menjelaskan beberapa ketentuan-ketentuan yang berlaku pada pelaksanaan program penelitian dan pengabdian kepada masyarakat tahun 2024.</p><p><img data-filename=\" \" style=\"width: 100%;\" src=\"/src/newsimg/ni6-1.png\"></p><p>Kemudian, Ibu Helmina Girsang, selaku Staff LPPM IT Del menjelaskan bahwa selain memfasilitasi dosen dalam pelaksanaan program penelitian dan pengabdian kepada masyarakat, IT Del melalui LPPM juga mendukung dosen IT Del untuk mengikuti seminar/konferensi ilmiah, melakukan publikasi jurnal, dan pemberian penghargaan untuk dosen yang karya ilmiahnya sudah dipublikasi dan dosen penerima hibah eksternal. Penghargaan ini menjadi salah satu bukti apresiasi atas luaran penelitian dosen dan diharapkan menjadi pemicu bagi dosen untuk menghasilkan penelitian yang berdampak dan berkualitas.</p></body></html>",
                'bgimage' => "../gambarnews/bg6.png",
                'start_date' => Carbon::now()->format('Y-m-d H:i:s'),
                'end_date' => Carbon::now()->addDays(5)->format('Y-m-d H:i:s'),
                'keterangan_status' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => "Sharing Session terkait Program Pembinaan Mahasiswa Wirausaha (P2MW)",
                'description' => "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\"><html><body><p>Pada hari Jumat, 23 Februari 2024 dilakukan sharing session terkait kegiatan Program Pembinaan Mahasiswa Wirausaha (P2MW). Kegiatan ini dilaksanakan oleh mahasiswa yang berhasil menang pada P2MW 2023 dan  mengikuti kegiatan KMI Expo 2023 beserta dosen Kordinator kegiatan P2MW, Bapak Wesly Siagian.</p><p><img data-filename=\" \" style=\"width: 100%;\" src=\"/src/newsimg/ni7-1.png\"></p><p>Kegiatan ini dilakukan untuk memberikan informasi kepada mahasiswa serta memotivasi dan memberikan dorongan untuk mau mencoba dan mengikuti kegiatan ini. Melalui kegiatan ini, harapannya akan semakin banyak mahasiswa yang dapat memenangkan kegiatan ini sekaligus menumbuhkan minat berwirausaha dalam mencetak para wirausahawan muda.</p></body></html>",
                'bgimage' => "../gambarnews/bg7.png",
                'start_date' => Carbon::now()->format('Y-m-d H:i:s'),
                'end_date' => Carbon::now()->addDays(5)->format('Y-m-d H:i:s'),
                'keterangan_status' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            
        ]);
    }
}
