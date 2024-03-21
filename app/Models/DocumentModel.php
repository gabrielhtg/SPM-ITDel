<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentModel extends Model
{
    use HasFactory;

    protected $table = 'documents';
    protected $fillable = [
        'name',
        'nama_dokumen',
        'nomor_dokumen',
        'deskripsi',
        'directory',
        'give_access_to',
        'give_edit_access_to',
        'created_by',
        
        'menggantikan_dokumen',
        'year',
        'tipe_dokumen',
        'start_date',
        'end_date',
        'keterangan_status',
        'can_see_by',
        'masa_berlaku',
    ];
    // Di dalam model DocumentModel
public function isReplaced()
{
    return !empty($this->menggantikan_dokumen);
}

    
}


