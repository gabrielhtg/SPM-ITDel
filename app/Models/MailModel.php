<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailModel extends Model
{
    use HasFactory;

    protected $table = 'mail';

    protected $fillable = [
        'mail_date'
    ];
}
