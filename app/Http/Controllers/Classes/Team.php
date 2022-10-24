<?php

namespace App\Http\Controllers\Classes;

use App\Models\Dotabuff;
use App\Http\Controllers\Classes\Hero;

class Team
{
    public $side;
    public $weak = 0;
    public $points = 0;
    public $power = 0;
    public $towerDamage = 0;
    public $heroDamage = 0;
    public $heroes;
    public $enemyHeroes;

    public function __construct($side, $heroes)
    {
        $this->side = $side;
        $this->heroes = $heroes;
    }

    public function matchupStatistics ($enemyHeroes) {
        $this->enemyHeroes = $enemyHeroes;

        foreach ($this->heroes as $hero) {
            $hero->farm = \App\Models\Hero::where('hero_name', $hero->name)->first()->farm;
            $hero->heroDamage = \App\Models\Hero::where('hero_name', $hero->name)->first()->hero_damage;
            $hero->towerDamage = \App\Models\Hero::where('hero_name', $hero->name)->first()->tower_damage;

            $this->towerDamage += \App\Models\Hero::where('hero_name', $hero->name)->first()->tower_damage;
            $this->heroDamage += \App\Models\Hero::where('hero_name', $hero->name)->first()->hero_damage;

            foreach ($this->enemyHeroes as $enemyHero) {
                $matchup = Dotabuff::where('hero', $hero->name)->where('matchup_hero', $enemyHero->name)->first();
                $vs = round($matchup['vs'], 1);

                $hero->points += $vs;
                $this->points += $vs;

                if ($vs > 0) $hero->power += $vs;
                if ($vs < -1.5) $hero->counterPicks[$enemyHero->name] = $vs;
                if ($vs < 0) {
                    $this->weak += $vs;
                    $hero->weak += $vs;
                }
            }
        }
    }
}
