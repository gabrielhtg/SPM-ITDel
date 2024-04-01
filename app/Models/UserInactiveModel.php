<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInactiveModel extends Model
{
    use HasFactory;

    protected $table = 'users_inactive';

    protected $fillable = [
        'name', 'username', 'phone', 'email', 'ends_on', 'status', 'role', 'profile_pict'
    ];
}
