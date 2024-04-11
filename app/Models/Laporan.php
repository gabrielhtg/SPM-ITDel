<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TipeLaporan;
use App\Models\User;

class Laporan extends Model
{
    protected $table = 'laporan';

    protected $fillable = [
        'id_tipelaporan',
        'direview_oleh',
        'created_by',
        'nama_laporan',
        'directory',
        'revisi',
        'tujuan',
        'accountable_to',
        'informable_to',
        'status',
        'approve_at',
        'reject_at',
    ];

    // Relasi dengan tabel tipe_laporan
    public function tipeLaporan()
    {
        return $this->belongsTo(TipeLaporan::class, 'id_tipelaporan');
    }

    public function jenisLaporan(){
        return $this->belongsTo(JenisLaporan::class,'id_tipelaporan');
    }
    

    // Relasi dengan tabel users (pembuat laporan)
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi dengan tabel users (disetujui oleh)
    public function reviewByUser()
    {
        return $this->belongsTo(User::class, 'direview_oleh');
    }

    // Relasi dengan tabel users (ditolak oleh)
    
}
