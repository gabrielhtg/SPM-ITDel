<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogLaporan extends Model
{
    use HasFactory;

    protected $table = 'log_laporan';

    protected $fillable = [
        'id_jenis_laporan',
        'upload_by',
        'status',
        'create_at',
        'approve_at',
        'id_tipe_laporan',
        'end_date',
    ];

    // Definisikan relasi ke tabel tipe_laporan
    public function jenisLaporan()
    {
        return $this->belongsTo(TipeLaporan::class, 'id_jenis_laporan');
    }

    // Definisikan relasi ke tabel users
    public function uploader()
    {
        return $this->belongsTo(User::class, 'upload_by');
    }
}
