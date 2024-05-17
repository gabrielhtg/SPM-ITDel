<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoleModel;
use App\Models\User;
use App\Models\JenisLaporan;
use App\Models\LogLaporan;

class LogLaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua ID role yang mengharuskan untuk mengirimkan dokumen
        $roleIds = RoleModel::whereNotNull('required_to_submit_document')->pluck('id')->toArray();

        // Ambil semua 'required_to_submit_document' dari RoleModel dan pecah berdasarkan titik koma
        $idtipe = RoleModel::whereNotNull('required_to_submit_document')->pluck('required_to_submit_document')->toArray();

        // Proses setiap elemen dalam $idtipe untuk memisahkan nilai yang dipisahkan oleh titik koma
        $flattenedIdtipe = [];
        foreach ($idtipe as $item) {
            $splitItems = explode(';', $item);
            foreach ($splitItems as $splitItem) {
                $flattenedIdtipe[] = trim($splitItem);
            }
        }

        // Hapus duplikat dan re-index array
        $flattenedIdtipe = array_values(array_unique($flattenedIdtipe));

        // Ambil semua 'id' dari JenisLaporan berdasarkan 'id_tipelaporan'
        $idjenis = JenisLaporan::whereIn('id_tipelaporan', $flattenedIdtipe)->pluck('id')->toArray();
        $jenislaporan = JenisLaporan::whereIn('id', $idjenis)->get();

        // Ambil semua pengguna yang memiliki role yang sesuai dengan ID yang diambil
        $users = User::whereIn('role', $roleIds)->get();

        // Iterasi melalui pengguna dan jenis laporan untuk membuat entri LogLaporan
        foreach ($users as $user) {
            foreach ($jenislaporan as $jenis) {
                LogLaporan::create([
                    'id_jenis_laporan' => $jenis->id,
                    'id_tipe_laporan' => $jenis->id_tipelaporan,
                    'upload_by' => $user->id,
                    'created_at' => now(), // Atau gunakan waktu lain yang sesuai
                    'approve_at' => null,
                    'end_date' => $jenis->end_date,
                ]);
            }
        }
    }
}
