<?php

namespace App\Http\Controllers\Classes;

use App\Models\Matchup;

class Team
{
    public $direHeroes = [];
    public $radiantHeroes = [];

    public $teamsData = [
        'dire' => [
            'heroes' => [],
            'weak' => 0,
            'points' => 0,
            'synergy' => 0
        ],
        'radiant' => [
            'heroes' => [],
            'weak' => 0,
            'points' => 0,
            'synergy' => 0
        ]
    ];

    public function __construct($direHeroes, $radiantHeroes)
    {
        $this->direHeroes = $direHeroes;
        $this->radiantHeroes = $radiantHeroes;
    }

    public function heroPower()
    {
        // Анализ очков для стороны тьмы
        foreach ($this->direHeroes as $direHero) {
            // Создание показателей для текущего героя
            $this->teamsData['dire']['heroes'][$direHero] = [
                'points' => 0,
                'powerPoints' => 0,
                'weakPoints' => 0,
                'counterPicks' => []
            ];

            foreach ($this->radiantHeroes as $radiantHero) {
                $matchup = Matchup::where('hero', $direHero)->where('matchup_hero', $radiantHero)->first();
                $vs = round($matchup['vs'], 1);

                $this->teamsData['dire']['heroes'][$direHero]['points'] += $vs;
                $this->teamsData['dire']['points'] += $vs;

                if ($vs > 0) $this->teamsData['dire']['heroes'][$direHero]['powerPoints'] += $vs;
                if ($vs < -1.5) $this->teamsData['dire']['heroes'][$direHero]['counterPicks'][$radiantHero] = $vs;
                if ($vs < 0) {
                    $this->teamsData['dire']['weak'] += $vs;
                    $this->teamsData['dire']['heroes'][$direHero]['weakPoints'] += $vs;
                }
            }
        }

        // Анализ очков для стороны света
        foreach ($this->radiantHeroes as $radiantHero) {
            // Создание показателей для текущего героя
            $this->teamsData['radiant']['heroes'][$radiantHero] = [
                'points' => 0,
                'powerPoints' => 0,
                'weakPoints' => 0,
                'counterPicks' => []
            ];

            foreach ($this->direHeroes as $direHero) {
                $matchup = Matchup::where('hero', $radiantHero)->where('matchup_hero', $direHero)->first();
                $vs = round($matchup['vs'], 1);

                $this->teamsData['radiant']['heroes'][$radiantHero]['points'] += $vs;
                $this->teamsData['radiant']['points'] += $vs;

                if ($vs > 0) $this->teamsData['radiant']['heroes'][$radiantHero]['powerPoints'] += $vs;
                if ($vs < -1.5) $this->teamsData['radiant']['heroes'][$radiantHero]['counterPicks'][$direHero] = $vs;
                if ($vs < 0) {
                    $this->teamsData['radiant']['weak'] += $vs;
                    $this->teamsData['radiant']['heroes'][$radiantHero]['weakPoints'] += $vs;
                }
            }
        }
    }

    public function heroSynergy()
    {
        // Анализ синергии команды тьмы
        foreach ($this->direHeroes as $direHero) {
            $this->teamsData['dire']['heroes'][$direHero]['heroSynergy'] = 0;

            foreach ($this->direHeroes as $direHeroSynergy) {
                if (!($direHero === $direHeroSynergy)) {
                    $heroSynergy = Matchup::where('hero', $direHero)->where('matchup_hero', $direHeroSynergy)->first();
                    $heroSynergyRounded = round($heroSynergy->with, 1);
                    $this->teamsData['dire']['heroes'][$direHero]['synergy'][$direHeroSynergy] = $heroSynergyRounded;
                    $this->teamsData['dire']['heroes'][$direHero]['heroSynergy'] += $heroSynergyRounded;

                    $this->teamsData['dire']['heroes'][$direHero]['points'] += $heroSynergyRounded;
                    $this->teamsData['dire']['points'] += $heroSynergyRounded;
                    $this->teamsData['dire']['synergy'] += $heroSynergyRounded;
                }
            }
        }


        // Анализ синергии команды света
        foreach ($this->radiantHeroes as $radiantHero) {
            $this->teamsData['radiant']['heroes'][$radiantHero]['heroSynergy'] = 0;

            foreach ($this->radiantHeroes as $radiantHeroSynergy) {
                if (!($radiantHero === $radiantHeroSynergy)) {
                    $heroSynergy = Matchup::where('hero', $radiantHero)->where('matchup_hero', $radiantHeroSynergy)->first();
                    $heroSynergyRounded = round($heroSynergy->with, 1);

                    $this->teamsData['radiant']['heroes'][$radiantHero]['synergy'][$radiantHeroSynergy] = $heroSynergyRounded;
                    $this->teamsData['radiant']['heroes'][$radiantHero]['heroSynergy'] += $heroSynergyRounded;

                    $this->teamsData['radiant']['heroes'][$radiantHero]['points'] += $heroSynergyRounded;
                    $this->teamsData['radiant']['points'] += $heroSynergyRounded;
                    $this->teamsData['radiant']['synergy'] += $heroSynergyRounded;
                }
            }
        }
    }
}
