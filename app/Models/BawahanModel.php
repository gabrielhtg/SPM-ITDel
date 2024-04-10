<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BawahanModel extends Model
{
    use HasFactory;

    protected $table = 'bawahan';

    protected $fillable = [
        'role',
        'bawahan'
    ];
}
