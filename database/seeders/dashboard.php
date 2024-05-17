<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class dashboard extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dashboard')->insert([
            'juduldashboard' => 'Tentang IT DEL',
            'keterangandashboard' => '
            <div>
                <h4 style = "margin-bottom:13px;font-weight:bold;">VISI</h4>
                <p style = "margin-bottom:24px; font-size:18px;">
                    Menjadi lembaga pendidikan tinggi yang unggul dan berperan sebagai agen pembaharu dan pelopor dalam pengembangan dan pemanfaatan teknologi bagi kemajuan dan kesejahteraan bangsa
                </p>

                <h5 style = "margin-bottom:13px;font-weight:bold;">MISI</h5>
                <div style = "margin-bottom:24px;font-size:18px;">
                    <ol>
                        <li>Menyelenggarakan dan mengembangkan proses pendidikan yang unggul, berkesinambungan, dan bermanfaat bagi masyarakat</li>
                        <li>Mengembangkan, menciptakan dan menyebarkan ilmu pengetahuan dan teknologi</li>
                        <li>Melaksanakan pembaharuan kemampuan, keterampilan, serta penerapan dan pengembangan rekayasa karya masyarakat</li>
                    </ol>
                </div>
                <h5 style = "margin-bottom:13px;font-weight:bold;">TUJUAN</h5>

                <div style="font-size:18px;">
                    <ol>
                        <li>Menghasilkan tenaga ahli yang unggul dan berperilaku MarTuhan, Marroha, Marbisuk, yang mempunyai ciri-ciri utama beriman dan bertakwa kepada Tuhan Yang Maha Esa, bijak, ahli, dan terampil dalam bidangnya, berwawasan luas, memiliki sifat kepeloporan, serta memiliki kesadaran dan tanggung jawab sosial.</li>
                        <li>Menghasilkan karya-karya ilmu pengetahuan dan teknologi yang berorientasi perkembangan keilmuan, pembelajaran, dan pemanfaatan di masyarakat.</li>
                        <li>Menghasilkan karya-karya pengabdian dan inovasi yang menyejahterakan masyarakat.</li>
                    </ol>
                </div>
            </div>
            ',
        ]);
        DB::table('hero_dashboard')->insert([
            'profilhero' => '../profilhero/icon.png',
            'judulhero' => 'SPM IT DEL',
            'tambahanhero' => 'Ini Merupakan Website SPM IT DEL',
            'gambarhero' => '../walpeper/header_admisifoto.jpg',
        ]);

        DB::table('table_akreditasi')->insert([
            'judulakreditasi' => 'Akreditasi',
            'gambarakreditasi' => '../gambarakreditasi/sertifikat.jpeg',
            'keteranganakreditasi' => 'Melalui keputusan BAN-PT Nomor 1855/BAN-PT/PMT2/2023 yang ditujukan kepada Dr. Arnaldo Marulitua Sinaga, ST., M.InfoTech. (Rektor IT Del), IT Del dinyatakan LOLOS Pemantauan dan Evaluasi Peringkat Akreditasi (PEPA). Dengan demikian, peringkat akreditasi IT Del (B) diperpanjang selama 5 tahun ke depan ( 2023 s.d. 2028).',
        ]);
    }
}
