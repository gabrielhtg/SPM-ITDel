<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class LogActivityModel extends Model
{
    use HasFactory;

    protected $table = 'log_activity';

    protected $fillable = [
        'log',
        'user'
    ];
}
