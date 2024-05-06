<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = "news";
    protected $fillable = [
        'title',
        'description',
        'bgimage',
        'descimg',
        'start_date',
        'end_date',
        'keterangan_status'
    ];
}
