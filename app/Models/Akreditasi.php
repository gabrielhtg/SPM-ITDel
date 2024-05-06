<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akreditasi extends Model
{
    use HasFactory;

    protected $table = "table_akreditasi";

    protected $fillable = [
        'judulakreditasi',
        'gambarakreditasi',
        'keteranganakreditasi',    
    ];
}

