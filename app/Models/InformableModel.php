<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformableModel extends Model
{
    use HasFactory;

    protected $table = 'informable';

    protected $fillable = [
        'role',
        'informable_to'
    ];
}
