<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroDocument extends Model
{
    use HasFactory;
    protected $table = 'hero_document';
    protected $fillable = ['titlehero', 'descriptionhero','imagehero'];

}
