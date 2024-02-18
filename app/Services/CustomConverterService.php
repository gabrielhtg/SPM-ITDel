<?php

namespace App\Services;

use App\Models\RoleModel;

class CustomConverterService
{
    static public function convertRole ($role) {
        return RoleModel::find($role)->role;
    }
}
