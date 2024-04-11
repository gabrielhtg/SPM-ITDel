<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisLaporan extends Model
{
    use HasFactory;

    protected $table = 'jenis_laporan';

    protected $fillable = [
        'id_tipelaporan',
        'nama',
        'start_date',
        'end_date',
    ];

    // Definisikan relasi ke tabel tipe_laporan
    public function tipeLaporan()
    {
        return $this->belongsTo(TipeLaporan::class, 'id_tipelaporan');
    }
}
