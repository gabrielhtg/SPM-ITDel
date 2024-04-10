<?php

namespace App\Services;

use App\Models\DocumentModel;
use App\Models\RoleModel;
use App\Models\TipeLaporan;
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
     * @param $status
     * @return string
     *
     * Method ini berfungsi untuk mengonversikan status user apakah dia masih aktif
     * atau tidak aktif lagi dan akan mengembalikan string.
     */
    static public function convertStatus($status) {
        if ($status !== null) {
            if ($status == true) {
                return "Active";
            }

            else {
                return "Inactive";
            }
        }

        return "Inactive";
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

    static public function getResponsibleTo ($idAtasan) : ?string {
        if($idAtasan != null) {
            $nextRole = $idAtasan;
            $responsibleTo = strval($idAtasan);

            while (true) {
                $visitedRole = RoleModel::find($nextRole);
                $nextRole = $visitedRole->atasan_id;

                if ($nextRole == null) {
                    break;
                }

                $responsibleTo = $responsibleTo . ';' . $nextRole;
            }
            return $responsibleTo;
        }

        return null;
    }

    /**
     * @param $idBawahan
     * @return bool
     *
     * Method ini digunakan untuk melakukan pengecekan terhadap semua role bawahan yang ada
     * apakah sudah nonaktif semua atau tidak.
     */
    public static function isAdaBawahanActive ($idBawahan) : bool {
        $roleBahahan = explode(";", $idBawahan);

        $semuaNonaktif = true;

        foreach ($roleBahahan as $e) {
            if (RoleModel::find($e)->status) {
                $semuaNonaktif = false;
                break;
            }
        }

        return $semuaNonaktif;
    }
    public static function isResponsible($array): bool
    {
        // Dapatkan semua role dari database
        $roles = RoleModel::all();

        // Iterasi melalui setiap role
        foreach($roles as $role) {
            // Periksa apakah nilai dalam $array ada di dalam kolom responsible_to dari role saat ini
            if (strpos($role->responsible_to, $array) !== false) {
                return true; // Jika ada, kembalikan true
            }
        }

        return false; // Jika tidak ada, kembalikan false
    }
    public static function isnotAccountable($array): bool
    {
        // Dapatkan semua role dari database
        $roles = RoleModel::find($array);


        if($roles->accountable_to===null){
            return true;
        }
        else{
            return false;
        }


    }
    public static function isAccountable($roleId): bool
    {
        // Dapatkan role berdasarkan id yang diberikan
        $role = RoleModel::findOrFail($roleId);
        
        // Dapatkan semua role dari database
        $roles = RoleModel::all();
        
        // Iterasi melalui setiap role
        foreach ($roles as $otherRole) {
            // Periksa apakah id role yang diberikan termasuk dalam accountable_to suatu role lain
            if (strpos($otherRole->accountable_to, $roleId) !== false) {
                return true; 
            }
        }
    
        return false; 
    }

   
    public static function isInformable($roleId): bool
    {
        // Dapatkan role berdasarkan id yang diberikan
        $role = RoleModel::findOrFail($roleId);
        
        // Dapatkan semua role dari database
        $roles = RoleModel::all();
        
        // Iterasi melalui setiap role
        foreach ($roles as $otherRole) {
            // Periksa apakah id role yang diberikan termasuk dalam informable_to suatu role lain
            if (strpos($otherRole->informable_to, $roleId) !== false) {
                return true; 
            }
        }
    
        return false; 
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
}
