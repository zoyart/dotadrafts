<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dotabuff extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'hero_id',
        'hero',
        'matchup_hero',
        'vs',
    ];
}
