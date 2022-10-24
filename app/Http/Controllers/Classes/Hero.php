<?php

namespace App\Http\Controllers\Classes;

class Hero
{
    public $name;
    public $weak = 0;
    public $power = 0;
    public $points = 0;
    public $towerDamage = 0;
    public $heroDamage = 0;
    public $farm = 0;
    public $counterPicks = [];

    public function __construct($name)
    {
        $this->name = $name;
    }
}
