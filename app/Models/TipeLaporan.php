<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeLaporan extends Model
{
    use HasFactory;
    protected $table = "tipe_laporan";


    protected $fillable = [
        'id',
        'nama_laporan',
        'start_date',
        'end_date'
    ];

}
