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
        'year',
        'end_date',
    ];

    // Definisikan relasi ke tabel tipe_laporan
    public function tipeLaporan()
    {
        return $this->belongsTo(TipeLaporan::class, 'id_tipelaporan');
    }

      /**
     * Mengambil nama tipe laporan berdasarkan ID.
     *
     * @param int $id
     * @return string|null
     */
    public static function getNamaTipeLaporanById(int $id): ?string
    {
        $tipeLaporan = static::find($id);
        return $tipeLaporan ? $tipeLaporan->nama_laporan : null;
    }

}
