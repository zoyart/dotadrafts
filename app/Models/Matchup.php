<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matchup extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'hero',
        'matchup_hero',
        'percent',
    ];
}
