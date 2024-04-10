<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountableModel extends Model
{
    use HasFactory;

    protected $table = 'accountable';

    protected $fillable = [
        'role',
        'accountable_to'
    ];
}
