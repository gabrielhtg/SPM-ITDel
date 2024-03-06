<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentTypeModel extends Model
{
    use HasFactory;
    protected $table = 'document_types';

    protected $fillable = [
        'jenis_dokumen',
    ];
}
