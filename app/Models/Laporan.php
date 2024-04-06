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
        'disetujui_oleh',
        'ditolak_oleh',
        'created_by',
        'nama_laporan',
        'directory',
        'revisi',
        'tujuan',
        'status',
        'approve_at',
        'reject_at',
    ];

    // Relasi dengan tabel tipe_laporan
    public function tipeLaporan()
    {
        return $this->belongsTo(TipeLaporan::class, 'id_tipelaporan');
    }

    // Relasi dengan tabel users (pembuat laporan)
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi dengan tabel users (disetujui oleh)
    public function approvedByUser()
    {
        return $this->belongsTo(User::class, 'disetujui_oleh');
    }

    // Relasi dengan tabel users (ditolak oleh)
    public function rejectedByUser()
    {
        return $this->belongsTo(User::class, 'ditolak_oleh');
    }
}
