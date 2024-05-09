<?php

namespace App\Services;

use App\Mail\DailyReminder;
use App\Mail\RejectRegisterMail;
use App\Models\AccountableModel;
use App\Models\BawahanModel;
use App\Models\DocumentModel;
use App\Models\DocumentTypeModel;
use App\Models\InformableModel;
use App\Models\JenisLaporan;
use App\Models\Laporan;
use App\Models\LogLaporan;
use App\Models\NotificationModel;
use App\Models\ResponsibleModel;
use App\Models\RoleModel;
use App\Models\TipeLaporan;
use App\Models\User;
use ErrorException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

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
    static public function convertRole($role): string
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
        } else {
            return "Belum Didefinisikan";
        }
    }

    /**
     * @param $laporan
     * @return string
     *
     * Method ini digunakan untuk mengonversi array id laporan yang ada menjadi nama aslinya
     */
    static public function convertDokumenLaporan($laporan): string
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
        } else {
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
    static public function convertTime($time): string
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
    static public function getLastLogin($time): string
    {
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
            return "$diffInDays days, $diffInHours hrs ago";
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
    static public function isCurrentRole($role): bool
    {
        $roles = explode(";", auth()->user()->role);

        foreach ($roles as $e) {
            try {
                if (strtolower(RoleModel::find($e)->role) == strtolower($role)) {
                    return true;
                }
            } catch (ErrorException $e) {
                return false;
            }
        }

        return false;
    }

    static public function isRoleExist($role): bool
    {
        $rolemodel = RoleModel::whereRaw('LOWER(role) = ?', strtolower($role))->first();

        if ($rolemodel != null) {
            return true;
        }

        return false;
    }

    static public function isUserRole($user, $expectedRole): bool
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

    static public function dokumenchange($id)
    {
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


    static public function isAllView($id): bool
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
    static public function getAccountableTo($idAtasan): array
    {
        if ($idAtasan != null) {
            $nextRole = $idAtasan;
            $accountableTo = array();
            $accountableTo[] = $idAtasan;

            while (true) {
                $visitedRole = RoleModel::find($nextRole);
                $nextRole = $visitedRole->atasan_id;

                if ($nextRole == null) {
                    break;
                }

                $accountableTo[] = $nextRole;
            }
            return $accountableTo;
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
    public static function isAdaBawahanActive($id): bool
    {

        $semuaNonaktif = true;

        foreach (BawahanModel::where('role', $id)->get() as $e) {
            if (RoleModel::find($e->bawahan)->status) {
                $semuaNonaktif = false;
                break;
            }
        }

        return $semuaNonaktif;
    }

    public static function isResponsible($roleIds): bool
    {
        // Pisahkan string $roleIds menjadi array berdasarkan delimiter ":"
        $roleIdsArray = explode(';', $roleIds);

        // Lakukan pencarian responsible model untuk setiap role
        foreach ($roleIdsArray as $roleId) {
            // Cari responsible model yang memiliki role yang sesuai
            $responsible = ResponsibleModel::where('responsible_to', 'LIKE', "%$roleId%")->first();

            // Jika responsible model ditemukan untuk setidaknya satu role, maka responsible
            if ($responsible !== null) {
                return true;
            }
        }

        // Jika tidak ada responsible model yang sesuai untuk semua role, maka tidak responsible
        return false;
    }

    public static function isnotAccountable($roleId): bool
    {
        // Dapatkan semua role dari database
        $accountable = AccountableModel::where('accountable_to', 'LIKE', "%$roleId%")->first();

        // Jika tidak ada accountable model yang sesuai, maka tidak accountable
        return $accountable !== null;
    }

    public static function isAccountable($roleIds): bool
    {
        // Pisahkan string $roleIds menjadi array berdasarkan delimiter ":"
        $roleIdsArray = explode(';', $roleIds);

        // Lakukan pencarian accountable model untuk setiap role
        foreach ($roleIdsArray as $roleId) {
            // Cari accountable model yang memiliki role yang sesuai
            $accountable = AccountableModel::where('accountable_to', 'LIKE', "%$roleId%")->first();

            // Jika accountable model ditemukan, maka role accountable
            if ($accountable !== null) {
                return true;
            }
        }

        // Jika tidak ada accountable model yang sesuai untuk semua role, maka tidak accountable
        return false;
    }

    public static function haveAccountable($roleId): bool
    {
        // Pisahkan string $roleId menjadi array ID
        $roleIds = explode(';', $roleId);
    
        // Cari accountable model yang memiliki setiap role yang sesuai
        $accountable = AccountableModel::where(function ($query) use ($roleIds) {
            foreach ($roleIds as $roleId) {
                $query->orWhere('role', 'LIKE', "%$roleId%");
            }
        })->first();
    
        // Jika tidak ada accountable model yang sesuai, maka tidak accountable
        return $accountable !== null;
    }
    


    public static function isInformable($roleIds): bool
    {
        // Pisahkan string $roleIds menjadi array berdasarkan delimiter ":"
        $roleIdsArray = explode(';', $roleIds);

        // Dapatkan informable model yang memiliki setidaknya satu dari role yang diberikan
        $informable = InformableModel::where(function ($query) use ($roleIdsArray) {
            foreach ($roleIdsArray as $roleId) {
                $query->orWhere('informable_to', 'LIKE', "%$roleId%");
            }
        })->first();

        // Jika tidak ada informable model yang sesuai, maka tidak informable
        return $informable !== null;
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
    public static function isLoggedUserHasAdminAccess(): bool
    {
        foreach (explode(";",auth()->user()->role) as  $e) {
            $role = RoleModel::find($e);
            if ($role) {
                if (RoleModel::find($e)->is_admin) {
                    return true;
                }
            }
        }

        return false;
    }

    public static function clearInformableTo($id): void
    {
        $informable = InformableModel::where('role', $id)->get();

        foreach ($informable as $e) {
            $e->delete();
        }
    }

    public static function clearAccountableTo($id): void
    {
        $accountable = AccountableModel::where('role', $id)->get();

        foreach ($accountable as $e) {
            $e->delete();
        }
    }

    public static function getAllBawahan($id): string
    {
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
        } else {
            return "Belum Didefinisikan";
        }
    }

    public static function clearResponsibleTo($id): void
    {
        $responsible = ResponsibleModel::where('role', $id)->get();

        foreach ($responsible as $e) {
            $e->delete();
        }
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

    public static function getRoleName($id): string
    {
        $role = RoleModel::find($id);

        return $role ? $role->role : '';
    }

    public static function getAllAccountableTo($id): string
    {
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
        } else {
            return "Belum Didefinisikan";
        }
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

    public static function getAllResponsible($id): string
    {
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
        } else {
            return "Belum Didefinisikan";
        }
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

    public static function getAllInformable($id): string
    {
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
        } else {
            return "Belum Didefinisikan";
        }
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

    public static function isResponsibleToRoleLaporan($id, $roleId): bool
    {
        // Pisahkan string $id menjadi array berdasarkan delimiter ";"
        $idArray = explode(';', $id);

        // Lakukan pencarian untuk setiap nilai dalam array $idArray
        foreach ($idArray as $singleId) {
            // Ambil nama peran berdasarkan singleId
            $roleName = self::getRoleName($singleId);

            // Ambil daftar responsible_to untuk peran yang diberikan
            $responsible = self::getAllResponsible($roleId);

            // Periksa apakah roleName terdapat dalam daftar responsible
            if (strpos($responsible, $roleName) !== false) {
                // Jika ada yang memenuhi syarat, kembalikan true
                return true;
            }
        }

        // Jika tidak ada yang memenuhi syarat, kembalikan false
        return false;
    }

    public static function isInformableToRoleLaporan($id, $roleId): bool
    {
        // Pisahkan string $id menjadi array berdasarkan delimiter ";"
        $idArray = explode(';', $id);

        // Lakukan pencarian untuk setiap nilai dalam array $idArray
        foreach ($idArray as $singleId) {
            // Ambil nama peran berdasarkan singleId
            $roleName = self::getRoleName($singleId);

            // Ambil daftar informable_to untuk peran yang diberikan
            $informable = self::getAllInformable($roleId);

            // Periksa apakah roleName terdapat dalam daftar informable
            if (strpos($informable, $roleName) !== false) {
                // Jika ada yang memenuhi syarat, kembalikan true
                return true;
            }
        }

        // Jika tidak ada yang memenuhi syarat, kembalikan false
        return false;
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
            if ($item->status === 'Menunggu' && $this->isAccountableToRoleLaporan(auth()->user()->role, $this->getUserRoleById($item->created_by))) {
                $banyakData++;
            }
        }

        // Mengembalikan jumlah data yang memenuhi kondisi
        return $banyakData;
    }

    public static function isAccountableToRoleLaporan($id, $roleId): bool
    {
        // Pisahkan string $id menjadi array berdasarkan delimiter ";"
        $idArray = explode(';', $id);

        // Lakukan pencarian untuk setiap nilai dalam array $idArray
        foreach ($idArray as $singleId) {
            // Ambil nama peran berdasarkan singleId
            $roleName = self::getRoleName($singleId);

            // Ambil daftar accountable_to untuk peran yang diberikan
            $accountableTo = self::getAllAccountableTo($roleId);

            // Periksa apakah roleName terdapat dalam daftar accountableTo
            if (strpos($accountableTo, $roleName) !== false) {
                // Jika ada yang memenuhi syarat, kembalikan true
                return true;
            }
        }

        // Jika tidak ada yang memenuhi syarat, kembalikan false
        return false;
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


    // Metode untuk mengecek apakah sebuah dokumen adalah dokumen pengganti

    public function getJenisLaporanWithoutLog($userId)
    {
        // Mendapatkan ID laporan yang diunggah oleh user saat ini
        $uploadedJenisLaporanIds = LogLaporan::where('upload_by', $userId)
        ->whereNotNull('status')
        ->pluck('id_jenis_laporan');



        $idrole = auth()->user()->role;
        $idsubmit = RoleModel::where('id', $idrole)->first();

        // Pisahkan string menjadi array
        $requiredIds = explode(';', $idsubmit->required_to_submit_document);

        // Mendapatkan jenis laporan yang belum diunggah oleh user saat ini dan sesuai dengan id_tipelaporan dari user saat ini
        $jenisLaporan = JenisLaporan::whereNotIn('id', $uploadedJenisLaporanIds)
                       ->whereIn('id_tipelaporan', $requiredIds)
                       ->get();

        return $jenisLaporan;
    }


    public function getDocumentNameAndTypeById($id)
    {
        // Cari dokumen berdasarkan ID
        $document = DocumentModel::find($id);

        // Pastikan dokumen ditemukan
        if ($document) {
            // Temukan tipe dokumen berdasarkan ID yang ada pada dokumen
            $tipe = DocumentTypeModel::find($document->tipe_dokumen);

            // Pastikan tipe dokumen ditemukan
            if ($tipe) {
                // Gabungkan nama dokumen dengan jenis dokumen
                $print = $document->name . ' (' . $tipe->jenis_dokumen . ')';

                // Kembalikan hasil gabungan
                return $print;
            }
        }

        // Jika dokumen atau tipe dokumen tidak ditemukan, kembalikan null
        return null;
    }

    public function getDocumentNameAndType()
    {
        // Ambil semua dokumen
        $documents = DocumentModel::all();
        $results = [];

        foreach ($documents as $document) {
            // Periksa apakah dokumen dengan ID tersebut ada dalam atribut "menggantikan_dokumen"
            if (!$this->isReplacementDocument($document->id)) {
                // Ambil tipe dokumen berdasarkan ID yang ada pada dokumen
                $tipe = DocumentTypeModel::find($document->tipe_dokumen);

                // Jika tipe dokumen ditemukan, lanjutkan
                if ($tipe) {
                    // Gabungkan nama dokumen dengan jenis dokumen
                    $print = $document->name . ' (' . $tipe->jenis_dokumen . ')';

                    // Tambahkan hasil gabungan ke dalam array dengan ID dokumen sebagai kunci
                    $results[$document->id] = $print;
                }
            }
        }

        // Kembalikan array hasil gabungan
        return $results;
    }

    private function isReplacementDocument($documentId)
    {
        return DocumentModel::where('menggantikan_dokumen', $documentId)->exists();
    }

    public function getPendingLaporanNotifications()
    {
        // Ambil semua laporan dengan status "Menunggu"
        $laporan = Laporan::where('status', 'Menunggu')->get();

        // Buat array untuk menyimpan notifikasi
        $notifications = [];

        // Loop melalui setiap laporan dan buat notifikasi untuk setiap laporan
        foreach ($laporan as $lap) {
            // Buat teks notifikasi
            $notificationText = $lap->createdByUser->name . ' Mengirimkan Laporan Untuk Diperiksa';

            // Tambahkan notifikasi ke dalam array
            $notifications[] = [
                'laporan' => $lap,
                'notification_text' => $notificationText,
            ];
        }

        return $notifications;
    }

    public static function countNotClickedNotification (): int
    {
        $notifications = NotificationModel::all();
        $temp = [];
        $count = 0;

        for ($i = 1; $i <= 5; $i++) {
            if ((count($notifications) - $i) > -1) {
                if ($notifications[count($notifications) - $i]->to == auth()->user()->id) {
                    $temp[] = $notifications[count($notifications) - $i];
                    if (!$notifications[count($notifications) - $i]->clicked) {
                        $count++;
                    }
                }
            }
        }

        return $count;
    }

    public static function getAllNotifications()
    {
        return NotificationModel::all()->sortByDesc('created_at');
    }

    public static function getNotifications(): array
    {
        $notifications = NotificationModel::all();
        $temp = [];

        for ($i = 1; $i <= 5; $i++) {
            if ((count($notifications) - $i) > -1) {
                if ($notifications[count($notifications) - $i]->to == auth()->user()->id) {
                    $temp[] = $notifications[count($notifications) - $i];
                }
            }
        }

        return $temp;
    }

    public static function getNotificationTime($time): string
    {
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
            return "$diffInDays days, $diffInHours hrs ago";
        }
    }

    public static function sendDailyReminder(): void
    {
        // Lakukan pengiriman email di sini
        $nowDate = now();
        $logLaporan = LogLaporan::where('end_date', '<', $nowDate)
            ->whereNull('status')
            ->get();

        $userIds = $logLaporan->pluck('upload_by')->toArray();

        // Ambil semua user yang memiliki id yang sesuai dengan user ids dari log laporan
        $userLaporan = User::whereIn('id', $userIds)->get();
        $emails = $userLaporan->pluck('email')->toArray();

        foreach ($emails as $email) {
            $idJenisLaporan = $logLaporan->pluck('id_jenis_laporan')->unique()->toArray(); // Get unique jenis laporan IDs
            $jenisLaporan = JenisLaporan::whereIn('id', $idJenisLaporan)->get();

            $messageContent = 'Segera kumpulkan: ';
            foreach ($jenisLaporan as $jenis) {
                $messageContent .= $jenis->nama . ', ';
            }
            $messageContent = rtrim($messageContent, ', '); // Remove the last comma and space

            echo $email;

            Mail::to($email)->send(new DailyReminder($messageContent));
        }
    }
}
