<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'role',
        'atasan_id',
        'created_at',
        'updated_at',
        'bawahan',
        'status',
        'responsible_to',
        'accountable_to',
        'informable_to'
    ];
}
