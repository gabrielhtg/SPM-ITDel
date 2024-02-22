<?php

namespace App\Services;

use App\Models\RoleModel;
use Illuminate\Support\Carbon;

class CustomConverterService
{
    static public function convertRole ($role) {
        return RoleModel::find($role)->role;
    }

    static public function convertTime ($time) {
        $carbonObject = Carbon::createFromFormat('Y-m-d H:i:s', $time);

        return $carbonObject->format('l, d M Y H:i:s');
    }

    static public function getLastLogin ($time) : string {
        $carbonObject = Carbon::createFromFormat('Y-m-d H:i:s', $time);

        $diffInMinutes = $carbonObject->diffInMinutes(Carbon::now());
        $diffInHours = $carbonObject->diffInHours(Carbon::now());
        $diffInDays = $carbonObject->diffInDays(Carbon::now());

        if ($diffInMinutes < 60) {
            return "$diffInMinutes minutes ago";
        } elseif ($diffInHours < 24) {
            return "$diffInHours hours ago";
        } else {
            return "$diffInDays days ago";
        }
    }
}
