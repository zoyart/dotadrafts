<?php

namespace App\Http\Controllers\Classes;

use App\Models\Dotabuff;
use App\Models\Hero;
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

    public $teamsDataDotabuff = [
        'dire' => [
            'heroes' => [],
            'weak' => 0,
            'points' => 0,
            'synergy' => 0,
            'towerDamage' => 0,
            'heroDamage' => 0,
        ],
        'radiant' => [
            'heroes' => [],
            'weak' => 0,
            'points' => 0,
            'synergy' => 0,
            'towerDamage' => 0,
            'heroDamage' => 0,
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
        foreach ($this->direHeroes as $direHero => $featureDireHero) {
            // Создание показателей для текущего героя
            $this->teamsData['dire']['heroes'][$direHero] = [
                'points' => 0,
                'powerPoints' => 0,
                'weakPoints' => 0,
                'counterPicks' => [],
                'role' => mb_strtoupper(str_replace('_','-', $featureDireHero['role'])),
            ];

            foreach ($this->radiantHeroes as $radiantHero => $featureRadiantHero) {
                $matchup = Matchup::where('hero', $direHero)->where('matchup_hero', $radiantHero)->first();
                $vs = round($matchup['vs'], 1);

                $this->teamsData['dire']['heroes'][$direHero]['points'] += $vs;
                $this->teamsData['dire']['points'] += $vs;

                if ($vs > 0) $this->teamsData['dire']['heroes'][$direHero]['powerPoints'] += $vs;
                if ($vs < -3) $this->teamsData['dire']['heroes'][$direHero]['counterPicks'][$radiantHero] = $vs;
                if ($vs < 0) {
                    $this->teamsData['dire']['weak'] += $vs;
                    $this->teamsData['dire']['heroes'][$direHero]['weakPoints'] += $vs;
                }
            }
        }

        // Анализ очков для стороны света
        foreach ($this->radiantHeroes as $radiantHero => $featureRadiantHero) {
            // Создание показателей для текущего героя
            $this->teamsData['radiant']['heroes'][$radiantHero] = [
                'points' => 0,
                'powerPoints' => 0,
                'weakPoints' => 0,
                'counterPicks' => [],
                'role' => mb_strtoupper(str_replace('_','-', $featureRadiantHero['role'])),
            ];

            foreach ($this->direHeroes as $direHero => $featureDireHero) {
                $matchup = Matchup::where('hero', $radiantHero)->where('matchup_hero', $direHero)->first();
                $vs = round($matchup['vs'], 1);

                $this->teamsData['radiant']['heroes'][$radiantHero]['points'] += $vs;
                $this->teamsData['radiant']['points'] += $vs;

                if ($vs > 0) $this->teamsData['radiant']['heroes'][$radiantHero]['powerPoints'] += $vs;
                if ($vs < -3) $this->teamsData['radiant']['heroes'][$radiantHero]['counterPicks'][$direHero] = $vs;
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
        foreach ($this->direHeroes as $direHero => $featureDireHero) {
            $this->teamsData['dire']['heroes'][$direHero]['heroSynergy'] = 0;

            foreach ($this->direHeroes as $direHeroSynergy => $featureDireHero) {
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
        foreach ($this->radiantHeroes as $radiantHero => $featureRadiantHero) {
            $this->teamsData['radiant']['heroes'][$radiantHero]['heroSynergy'] = 0;

            foreach ($this->radiantHeroes as $radiantHeroSynergy => $featureRadiantHero) {
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

    public function heroSynergyDotabuff()
    {
        // Анализ очков для стороны тьмы
        foreach ($this->direHeroes as $direHero => $featureDireHero) {
            // Создание показателей для текущего героя
            $this->teamsDataDotabuff['dire']['heroes'][$direHero] = [
                'points' => 0,
                'powerPoints' => 0,
                'weakPoints' => 0,
                'counterPicks' => [],
                'role' => mb_strtoupper(str_replace('_','-', $featureDireHero['role'])),
                'farm' => Hero::where('hero_name', $direHero)->first()->farm,
                'heroDamage' => Hero::where('hero_name', $direHero)->first()->hero_damage,
                'towerDamage' => Hero::where('hero_name', $direHero)->first()->tower_damage,
            ];
            $this->teamsDataDotabuff['dire']['towerDamage'] += Hero::where('hero_name', $direHero)->first()->tower_damage;
            $this->teamsDataDotabuff['dire']['heroDamage'] += Hero::where('hero_name', $direHero)->first()->hero_damage;

            foreach ($this->radiantHeroes as $radiantHero => $featureRadiantHero) {
                $matchup = Dotabuff::where('hero', $direHero)->where('matchup_hero', $radiantHero)->first();
                $vs = round($matchup['vs'], 1);

                $this->teamsDataDotabuff['dire']['heroes'][$direHero]['points'] += $vs;
                $this->teamsDataDotabuff['dire']['points'] += $vs;

                if ($vs > 0) $this->teamsDataDotabuff['dire']['heroes'][$direHero]['powerPoints'] += $vs;
                if ($vs < -1.5) $this->teamsDataDotabuff['dire']['heroes'][$direHero]['counterPicks'][$radiantHero] = $vs;
                if ($vs < 0) {
                    $this->teamsDataDotabuff['dire']['weak'] += $vs;
                    $this->teamsDataDotabuff['dire']['heroes'][$direHero]['weakPoints'] += $vs;
                }
            }
        }

        // Анализ очков для стороны света
        foreach ($this->radiantHeroes as $radiantHero => $featureRadiantHero) {
            // Создание показателей для текущего героя
            $this->teamsDataDotabuff['radiant']['heroes'][$radiantHero] = [
                'points' => 0,
                'powerPoints' => 0,
                'weakPoints' => 0,
                'counterPicks' => [],
                'role' => mb_strtoupper(str_replace('_','-', $featureRadiantHero['role'])),
                'farm' => Hero::where('hero_name', $radiantHero)->first()->farm,
                'heroDamage' => Hero::where('hero_name', $radiantHero)->first()->hero_damage,
                'towerDamage' => Hero::where('hero_name', $radiantHero)->first()->tower_damage,
            ];
            $this->teamsDataDotabuff['radiant']['towerDamage'] += Hero::where('hero_name', $radiantHero)->first()->tower_damage;
            $this->teamsDataDotabuff['radiant']['heroDamage'] += Hero::where('hero_name', $radiantHero)->first()->hero_damage;

            foreach ($this->direHeroes as $direHero => $featureDireHero) {
                $matchup = Dotabuff::where('hero', $radiantHero)->where('matchup_hero', $direHero)->first();
                $vs = round($matchup['vs'], 1);

                $this->teamsDataDotabuff['radiant']['heroes'][$radiantHero]['points'] += $vs;
                $this->teamsDataDotabuff['radiant']['points'] += $vs;

                if ($vs > 0) $this->teamsDataDotabuff['radiant']['heroes'][$radiantHero]['powerPoints'] += $vs;
                if ($vs < -1.5) $this->teamsDataDotabuff['radiant']['heroes'][$radiantHero]['counterPicks'][$direHero] = $vs;
                if ($vs < 0) {
                    $this->teamsDataDotabuff['radiant']['weak'] += $vs;
                    $this->teamsDataDotabuff['radiant']['heroes'][$radiantHero]['weakPoints'] += $vs;
                }
            }
        }
    }
}
