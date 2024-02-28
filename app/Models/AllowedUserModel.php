<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllowedUserModel extends Model
{
    use HasFactory;

    protected $table = 'allowed_user';

    protected $fillable = [
        'created_at',
        'email',
        'created_by'
    ];
}
