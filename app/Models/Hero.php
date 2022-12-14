<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'hero_name',
        'tower_damage',
        'hero_damage',
        'farm',
    ];
}
