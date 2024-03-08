<?php

namespace App\Services;

use App\Http\Controllers\RoleController;
use App\Models\RoleModel;
use Illuminate\Support\Carbon;
use App\Models\User;


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
            return "Not Defined Yet";
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
     *  Ini adalah fungsi yang tidak memiliki parameter yang berfungsi sebagai alat untuk
     *  mengecek apakah user yang sekarang login adalah seorang admin atau tidak.
     */
    static public function isCurrentRole ($role): bool
    {
        $roles = explode(";", auth()->user()->role);

        foreach ($roles as $e) {
            if (strtolower(RoleModel::find($e)->role) == strtolower($role)) {
                return true;
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

    static public function isUserRole ($user, $expectedRole) {
        $roles = explode(";", $user->role);

        foreach ($roles as $e) {
            if (strtolower(RoleModel::find($e)->role) == strtolower($expectedRole)) {
                return true;
            }
        }

        return false;
    }

    static public function isAdmin () {
        if (RoleModel::find(auth()->user()->role)->role == "Admin") {
            return true;
        }

        return false;

        // dump(RoleModel::find(auth()->user()->role)->role == "Admin");
        // sleep(10);
    }

}
