<?php

namespace App\Http\Controllers\Classes;

use App\Models\Dotabuff;

class Team
{
    public $side;
    public $weak = 0;
    public $points = 0;
    public $power = 0;
    public $towerDamage = 0;
    public $heroDamage = 0;
    public $heroes = [];

    public function __construct($side, $heroes)
    {
        $this->side = $side;

        foreach ($heroes as $hero => $feature) {
            $this->heroes[] = new Hero($hero);
        }
    }

    public function matchupStatistics ($enemyHeroes) {
        foreach ($enemyHeroes as $enemyHero => $feature) {
            $enemyHeroesArr[] = new Hero($enemyHero);
        }

        foreach ($this->heroes as $hero) {
            $hero->farm = \App\Models\Hero::where('hero_name', $hero->name)->first()->farm;
            $hero->heroDamage = \App\Models\Hero::where('hero_name', $hero->name)->first()->hero_damage;
            $hero->towerDamage = \App\Models\Hero::where('hero_name', $hero->name)->first()->tower_damage;

            $this->towerDamage += \App\Models\Hero::where('hero_name', $hero->name)->first()->tower_damage;
            $this->heroDamage += \App\Models\Hero::where('hero_name', $hero->name)->first()->hero_damage;

            foreach ($enemyHeroesArr as $enemyHero) {
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
