<?php

namespace App\Services;

class CustomConverterService
{
    public function convertRole ($role) {
        switch ($role) {
            case 1:
                return 'Rektor';
            case 2:
                return 'Wakil Rektor';
            case 3:
                return 'Ketua SPPM';
            case 4:
                return 'Anggota SPPM';
            default:
                return 'Unknown Role';
        }
    }
}
