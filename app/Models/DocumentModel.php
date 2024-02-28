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
            'directory',
            'give_access_to',
            'created_by',
            'status', 
            'year',
            'tipe_dokumen', 
            'expried_date', 
            'created_at'
        ];
}
    