<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tempo extends Model
{
    use HasFactory;

    public $timestamps = false;

    // Win rate и gradient в процентах
    protected $fillable = [
        'hero_name',
        'matches',
        'early_duration',
        'middle_duration',
        'late_duration',
        'early_winrate',
        'middle_winrate',
        'late_winrate',
        'gradient'
    ];
}
