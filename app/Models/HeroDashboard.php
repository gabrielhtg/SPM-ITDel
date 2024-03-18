<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroDashboard extends Model
{
    use HasFactory;

    protected $table = "hero_dashboard";
    
    protected $fillable = [
        'judulhero',
        'tambahanhero',
        'gambarhero',
    ];
}
