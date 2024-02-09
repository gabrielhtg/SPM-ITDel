<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterInvitationModel extends Model
{
    use HasFactory;

    protected $table = 'register_invitation';

    protected $fillable = [
        'email',
        'role',
        'token'
    ];
}
