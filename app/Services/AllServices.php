<?php

namespace App\Services;

use App\Models\AccountableModel;
use App\Models\BawahanModel;
use App\Models\DocumentModel;
use App\Models\InformableModel;
use App\Models\ResponsibleModel;
use App\Models\RoleModel;
use App\Models\TipeLaporan;
use App\Models\LogLaporan;
use App\Models\JenisLaporan;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Support\Carbon;


class AllServices
{
    /**
     * @param $role
     * @return string
     *
     * Method ini berfungsi untuk mengonversikan role ke dalam string berdasarkan id role tersebut.
     * Method ini juga dapat digunakan untuk mengonversikan role ke dalam string apabila id role
     * tersebut berada dalam format id;id
     */
    static public function convertRole ($role): string
    {
        if ($role) {
            $roles = explode(";", $role);

            $output = '';

            $len = count($roles);
            $i = 0;

            foreach ($roles as $e) {
                $output = $output . trim(RoleModel::find($e)->role);

                if ($i != $len - 1) {
                    $output = $output . ', ';
                }

                $i++;
            }

            return $output;
        }

        else {
            return "Belum Didefinisikan";
        }
    }

    /**
     * @param $laporan
     * @return string
     *
     * Method ini digunakan untuk mengonversi array id laporan yang ada menjadi nama aslinya
     */
    static public function convertDokumenLaporan ($laporan): string
    {
        if ($laporan !== null) {
            $currentLaporan = explode(";", $laporan);

            $output = '';

            $len = count($currentLaporan);
            $i = 0;

            foreach ($currentLaporan as $e) {
                $output = $output . trim(TipeLaporan::find($e)->nama_laporan);

                if ($i != $len - 1) {
                    $output = $output . ', ';
                }

                $i++;
            }

            return $output;
        }

        else {
            return "Belum Didefinisikan";
        }
    }


    /**
     * @param $time
     * @return string
     *
     * Method ini berfungsi untuk mengonversikan waktu ke format
     * seperti berikut ini Fri, 08 Mar 2024
     */
    static public function convertTime ($time): string
    {
        $carbonObject = Carbon::createFromFormat('Y-m-d H:i:s', $time);

        return $carbonObject->format('D, d M Y');
    }

    /**
     * @param $time
     * @return string
     *
     * Method ini berfungsi untuk menampilkan sudah berapa lama si user ini login.
     * Cara kerjanya adalah dengan megurangkan waktu sekarang dengan last login at
     */
    static public function getLastLogin ($time) : string {
        $carbonObject = Carbon::createFromFormat('Y-m-d H:i:s', $time);

        $diffInMinutes = $carbonObject->diffInMinutes(Carbon::now());
        $diffInHours = $carbonObject->diffInHours(Carbon::now());
        $diffInDays = $carbonObject->diffInDays(Carbon::now());

        if ($diffInMinutes < 60) {
            return "$diffInMinutes mnts ago";
        } elseif ($diffInHours < 24) {
            $diffInMinutes = $diffInMinutes % 60;
            return "$diffInHours hrs, $diffInMinutes mnts ago";
        } else {
            $diffInHours = $diffInHours % 24;
            return "$diffInDays days, $diffInHours mnts ago";
        }
    }

    /**
     * @return bool
     *
     * Ini adalah fungsi yang memiliki parameter role untuk
     * memeriksa apakah role user yang saat ini login adalah user
     * yang memiliki role sesuai dengan apa yang dimasukkan pada
     * parameter.
     */
    static public function isCurrentRole ($role): bool
    {
        $roles = explode(";", auth()->user()->role);

        foreach ($roles as $e) {
           try {
               if (strtolower(RoleModel::find($e)->role) == strtolower($role)) {
                   return true;
               }
           } catch (\ErrorException $e) {
               return false;
           }
        }

        return false;
    }

    static public function isRoleExist($role) : bool {
        $rolemodel = RoleModel::whereRaw('LOWER(role) = ?', strtolower($role))->first();

        if ($rolemodel != null) {
            return true;
        }

        return false;
    }

    static public function isUserRole ($user, $expectedRole): bool
    {
        $roles = explode(";", $user->role);
        $expectedRoles = explode(";", $expectedRole);

        foreach ($expectedRoles as $e) {
            if (in_array($e, $roles)) {
                return true;
            }
        }

        return false;
    }

    static public function dokumenchange($id) {
        if ($id) {
            $document = DocumentModel::find($id); // Mengambil dokumen berdasarkan ID
            if ($document) {
                return $document->nama_dokumen; // Mengembalikan nama dokumen jika ditemukan
            } else {
                return "Tidak Menggantikan Dokumen Apapun"; // Mengembalikan pesan jika dokumen tidak ditemukan
            }
        } else {
            return "Tidak Menggantikan Dokumen Apapun"; // Mengembalikan pesan jika ID dokumen kosong atau null
        }
    }



    static public function isAllView ($id) : bool
    {

        if (DocumentModel::find($id)->give_access_to == 0) {
            return true;
        }
        return false;
    }

    /**
     * @param $idAtasan
     * @return array
     *
     * Method ini digunakan untuk mendapatkan role dengan $idAtasan Responsible ke role apa saja
     */
    static public function getResponsibleTo ($idAtasan) : array {
        if($idAtasan != null) {
            $nextRole = $idAtasan;
            $responsibleTo = array();
            $responsibleTo[] = $idAtasan;

            while (true) {
                $visitedRole = RoleModel::find($nextRole);
                $nextRole = $visitedRole->atasan_id;

                if ($nextRole == null) {
                    break;
                }

                $responsibleTo[] = $nextRole;
            }
            return $responsibleTo;
        }

        return [];
    }

    /**
     * @param $idBawahan
     * @return bool
     *
     * Method ini digunakan untuk melakukan pengecekan terhadap semua role bawahan yang ada
     * apakah sudah nonaktif semua atau tidak.
     */
    public static function isAdaBawahanActive ($id) : bool {

        $semuaNonaktif = true;

        foreach (BawahanModel::where('role', $id)->get() as $e) {
            if (RoleModel::find($e->bawahan)->status) {
                $semuaNonaktif = false;
                break;
            }
        }

        return $semuaNonaktif;
    }
    public static function isResponsible($roleId): bool
    {
       // Dapatkan role berdasarkan id yang diberikan
       $accountable = ResponsibleModel::where('responsible_to', 'LIKE', "%$roleId%")->first();

        // Jika tidak ada accountable model yang sesuai, maka tidak accountable
        return $accountable !== null;
    }
    public static function isnotAccountable($roleId): bool
    {
        // Dapatkan semua role dari database
        $accountable = AccountableModel::where('accountable_to', 'LIKE', "%$roleId%")->first();

        // Jika tidak ada accountable model yang sesuai, maka tidak accountable
        return $accountable !== null;
    }

        public static function isAccountable($roleId): bool
    {
        // Cari accountable model yang memiliki role yang sesuai
        $accountable = AccountableModel::where('accountable_to', 'LIKE', "%$roleId%")->first();

        // Jika tidak ada accountable model yang sesuai, maka tidak accountable
        return $accountable !== null;
    }
    public static function haveAccountable($roleId): bool
    {
        // Cari accountable model yang memiliki role yang sesuai
        $accountable = AccountableModel::where('role', 'LIKE', "%$roleId%")->first();

        // Jika tidak ada accountable model yang sesuai, maka tidak accountable
        return $accountable !== null;
    }




    public static function isInformable($roleId): bool
    {
        $accountable = InformableModel::where('informable_to', 'LIKE', "%$roleId%")->first();

        // Jika tidak ada accountable model yang sesuai, maka tidak accountable
        return $accountable !== null;
    }

    public static function isThisRoleExistInArray($array, $id): bool
    {
        $temp = explode(";", $array);

        if (in_array($id, $temp)) {
            return true;
        }

        return false;
    }

    public static function removeIdFromArray($array, $id): string
    {
        $temp = is_string($array) ? explode(";", $array) : $array;
        $returnValue = "";

        foreach ($temp as $e) {
            if ($e != $id) {
                $returnValue .= $e . ";";
            }
        }

        if (!empty($returnValue)) {
            $returnValue = substr($returnValue, 0, -1);
        }

        return $returnValue;
    }

    /**
     * @return bool
     *
     * Method ini digunakan untuk mengecek apakah user yang sedang login sekarang adalah seorang admin atau tidak
     */
    public static  function isLoggedUserHasAdminAccess () : bool {
        $isAdmin = RoleModel::find(auth()->user()->role);

        return $isAdmin->is_admin;
    }

    public static function getAllInformable($id) : string {
        $informableTo = InformableModel::where("role", $id)->get();

        $output = '';

        if ($informableTo !== null) {
            foreach ($informableTo as $e) {
                $output = $output . RoleModel::find($e->informable_to)->role . ', ';
            }

            if (substr($output, 0, -2) === '') {
                return "Belum Didefinisikan";
            }

            return substr($output, 0, -2);
        }

        else {
            return "Belum Didefinisikan";
        }
    }

    public static function clearInformableTo($id) : void
    {
        $informable = InformableModel::where('role', $id)->get();

        foreach ($informable as $e) {
            $e->delete();
        }
    }

    public static function getAllAccountableTo($id) : string {
        $accountableTo = AccountableModel::where("role", $id)->get();

        $output = '';

        if ($accountableTo !== null) {
            foreach ($accountableTo as $e) {
                $output = $output . RoleModel::find($e->accountable_to)->role . ', ';
            }

            if (substr($output, 0, -2) === '') {
                return "Belum Didefinisikan";
            }

            return substr($output, 0, -2);
        }

        else {
            return "Belum Didefinisikan";
        }
    }

    public static function clearAccountableTo($id) : void
    {
        $accountable = AccountableModel::where('role', $id)->get();

        foreach ($accountable as $e) {
            $e->delete();
        }
    }

    public static function getAllBawahan($id) : string {
        $bawahan = BawahanModel::where("role", $id)->get();

        $output = '';

        if ($bawahan !== null) {
            foreach ($bawahan as $e) {
                $output = $output . RoleModel::find($e->bawahan)->role . ', ';
            }

            if (substr($output, 0, -2) === '') {
                return "Belum Didefinisikan";
            }

            return substr($output, 0, -2);
        }

        else {
            return "Belum Didefinisikan";
        }
    }

    public static function getAllResponsible($id) : string {
        $responsibleTo = ResponsibleModel::where("role", $id)->get();

        $output = '';

        if ($responsibleTo !== null) {
            foreach ($responsibleTo as $e) {
                $output = $output . RoleModel::find($e->responsible_to)->role . ', ';
            }

            if (substr($output, 0, -2) === '') {
                return "Belum Didefinisikan";
            }

            return substr($output, 0, -2);
        }

        else {
            return "Belum Didefinisikan";
        }
    }

    public static function clearResponsibleTo($id) : void
    {
        $responsible = ResponsibleModel::where('role', $id)->get();

        foreach ($responsible as $e) {
            $e->delete();
        }
    }

    public static function getRoleName($id): string
    {
        $role = RoleModel::find($id);

        return $role ? $role->role : '';
    }

    public static function isAccountableToRole($id, $roleId): bool
{
    // Ambil nama peran berdasarkan ID
    $roleName = self::getRoleName($id);

    // Ambil daftar accountable_to untuk peran yang diberikan
    $accountableTo = self::getAllAccountableTo($roleId);

    // Periksa apakah roleName terdapat dalam daftar accountableTo
    return strpos($accountableTo, $roleName) !== false;
}
public static function isResponsibleToRole($id, $roleId): bool
{
    // Ambil nama peran berdasarkan ID
    $roleName = self::getRoleName($id);

    // Ambil daftar accountable_to untuk peran yang diberikan
    $responsible = self::getAllResponsible($roleId);

    // Periksa apakah roleName terdapat dalam daftar accountableTo
    return strpos($responsible, $roleName) !== false;
}

public static function isInformableToRole($id, $roleId): bool
{
    // Ambil nama peran berdasarkan ID
    $roleName = self::getRoleName($id);

    // Ambil daftar accountable_to untuk peran yang diberikan
    $informable = self::getAllInformable($roleId);

    // Periksa apakah roleName terdapat dalam daftar accountableTo
    return strpos($informable, $roleName) !== false;
}



public function getUserRoleById($userId)
    {
        // Cari user berdasarkan ID
        $user = User::find($userId);

        // Jika user ditemukan, kembalikan rolenya
        if ($user) {
            return $user->role;
        }

        // Jika user tidak ditemukan, kembalikan null
        return null;
    }
    public function isLaporanIdInCekLaporan($laporanId)
    {
        // Cek apakah ID laporan ada di kolom cek_revisi dan statusnya disetujui
        $cekLaporan = Laporan::where('cek_revisi', $laporanId)
                             ->where('status', 'Disetujui')
                             ->first();

        // Jika ada, return false
        if ($cekLaporan) {
            return false;
        }

        // Jika tidak ada, return true
        return true;
    }
    public function getNamaLaporanById($laporanId)
    {
        // Cari laporan berdasarkan ID
        $laporan = Laporan::find($laporanId);

        // Jika laporan ditemukan, kembalikan nama laporannya
        if ($laporan) {
            return $laporan->nama_laporan;
        }

        // Jika laporan tidak ditemukan, kembalikan null
        return null;
    }

    public function countWaitingLaporan($userId)
    {
        // Mengambil semua data laporan
        $laporan = Laporan::all();

        // Inisialisasi variabel untuk menghitung banyak data
        $banyakData = 0;

        // Iterasi setiap laporan
        foreach ($laporan as $item) {
            // Periksa apakah status laporan adalah 'Menunggu' dan user mempunyai akses ke laporan ini
            if ($item->status === 'Menunggu' && $this->isAccountableToRole(auth()->user()->role, $this->getUserRoleById($item->created_by))) {
                $banyakData++;
            }
        }

        // Mengembalikan jumlah data yang memenuhi kondisi
        return $banyakData;
    }

    public function getJenisLaporanWithoutLog($userId)
    {
        // Mendapatkan ID laporan yang diunggah oleh user saat ini
        $uploadedJenisLaporanIds = LogLaporan::where('upload_by', $userId)
            ->pluck('id_jenis_laporan');

        // Mendapatkan jenis laporan yang belum diunggah oleh user saat ini
        $jenisLaporan = JenisLaporan::whereNotIn('id', $uploadedJenisLaporanIds)
            ->get();

        return $jenisLaporan;
    }

    public static function isExistAsBahawan($idRole, $idBawahan)
    {
        $role = BawahanModel::where("role", $idRole)->get();

        if ($role !== null) {
            foreach ($role as $e) {
                if ($e->bawahan == $idBawahan) {
                    return true;
                }
            }
        }

        return false;
    }


}
