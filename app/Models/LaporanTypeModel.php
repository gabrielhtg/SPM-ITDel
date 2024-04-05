<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanTypeModel extends Model
{
    use HasFactory;
    protected $table = 'tipe_laporan';

    protected $fillable = [
        'nama_laporan',
    ];
}
