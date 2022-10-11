<?php

namespace App\Http\Controllers\Classes;

use App\Models\Matchup;
use App\Models\Tempo;

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

                $this->teamsData['dire']['heroes'][$direHero]['points'] -= $matchup['vs'];
                $this->teamsData['dire']['points'] -= $matchup['vs'];

                if ($matchup['vs'] < 0) {
                    $this->teamsData['dire']['heroes'][$direHero]['powerPoints'] -= $matchup['vs'];
                }
                if ($matchup['vs'] > 0) {
                    $this->teamsData['dire']['weak'] += $matchup['vs'];
                    $this->teamsData['dire']['heroes'][$direHero]['weakPoints'] += $matchup['vs'];
                }
                if ($matchup['vs'] > 1.5) {
                    $this->teamsData['dire']['heroes'][$direHero]['counterPicks'][$radiantHero] = $matchup['vs'];
                }
            }
        }

        // Анализ очков для стороны света
        foreach ($this->radiantHeroes as $radiantHero) {
            // Создание показателей для текущего героя
            $this->teamsData['radiant']['heroes'][$radiantHero] = [
                'points' => 0, 'powerPoints' => 0, 'weakPoints' => 0, 'counterPicks' => []
            ];

            foreach ($this->direHeroes as $direHero) {
                $matchup = Matchup::where('hero', $radiantHero)->where('matchup_hero', $direHero)->first();

                $this->teamsData['radiant']['heroes'][$radiantHero]['points'] -= $matchup['vs'];
                $this->teamsData['radiant']['points'] -= $matchup['vs'];

                if ($matchup['vs'] < 0) {
                    $this->teamsData['radiant']['heroes'][$radiantHero]['powerPoints'] -= $matchup['vs'];
                }
                if ($matchup['vs'] > 0) {
                    $this->teamsData['radiant']['weak'] += $matchup['vs'];
                    $this->teamsData['radiant']['heroes'][$radiantHero]['weakPoints'] += $matchup['vs'];
                }
                if ($matchup['vs'] > 1.5) {
                    $this->teamsData['radiant']['heroes'][$radiantHero]['counterPicks'][$direHero] = $matchup['vs'];
                }
            }
        }
    }

    public function heroTempo()
    {
        /*=========================
        Анализ темпа команды тьмы
        =========================*/
        $this->teamsData['dire']['tempo'] = ['totalGradient' => 0];

        foreach ($this->direHeroes as $direHero) {
            $heroTempo = Tempo::where('hero_name', $direHero)->first();

            $earlyWinrateDire[] = $heroTempo->early_winrate;
            $middleWinrateDire[] = $heroTempo->middle_winrate;
            $lateWinrateDire[] = $heroTempo->late_winrate;

            $this->teamsData['dire']['tempo']['totalGradient'] += $heroTempo->gradient;
            $this->teamsData['dire']['heroes'][$direHero]['tempo'] = [
                'heroName' => $heroTempo->hero_name,
                'matches' => $heroTempo->matches,
                'earlyWinrate' => $heroTempo->early_winrate,
                'middleWinrate' => $heroTempo->middle_winrate,
                'lateWinrate' => $heroTempo->late_winrate,
                'gradient' => $heroTempo->gradient,
            ];
        }

        $this->teamsData['dire']['tempo']['totalEarlyWinrate'] = array_sum($earlyWinrateDire) / count($earlyWinrateDire);
        $this->teamsData['dire']['tempo']['totalMiddleWinrate'] = array_sum($middleWinrateDire) / count($middleWinrateDire);
        $this->teamsData['dire']['tempo']['totalLateWinrate'] = array_sum($lateWinrateDire) / count($lateWinrateDire);


        /*=========================
        Анализ темпа команды света
        =========================*/
        $this->teamsData['radiant']['tempo'] = ['totalGradient' => 0];

        foreach ($this->radiantHeroes as $radiantHero) {
            $heroTempo = Tempo::where('hero_name', $radiantHero)->first();

            $earlyWinrateRadiant[] = $heroTempo->early_winrate;
            $middleWinrateRadiant[] = $heroTempo->middle_winrate;
            $lateWinrateRadiant[] = $heroTempo->late_winrate;

            $this->teamsData['radiant']['tempo']['totalGradient'] += $heroTempo->gradient;
            $this->teamsData['radiant']['heroes'][$radiantHero]['tempo'] = [
                'heroName' => $heroTempo->hero_name,
                'matches' => $heroTempo->matches,
                'earlyWinrate' => $heroTempo->early_winrate,
                'middleWinrate' => $heroTempo->middle_winrate,
                'lateWinrate' => $heroTempo->late_winrate,
                'gradient' => $heroTempo->gradient,
            ];
        }

        $this->teamsData['radiant']['tempo']['totalEarlyWinrate'] = array_sum($earlyWinrateRadiant) / count($earlyWinrateRadiant);
        $this->teamsData['radiant']['tempo']['totalMiddleWinrate'] = array_sum($middleWinrateRadiant) / count($middleWinrateRadiant);
        $this->teamsData['radiant']['tempo']['totalLateWinrate'] = array_sum($lateWinrateRadiant) / count($lateWinrateRadiant);
    }

    public function heroSynergy() {
        /*=========================
        Анализ синергии команды тьмы
        =========================*/
        foreach ($this->direHeroes as $direHero) {
            $this->teamsData['dire']['heroes'][$direHero]['heroSynergy'] = 0;

            foreach ($this->direHeroes as $direHeroSynergy) {
                if (!($direHero === $direHeroSynergy)) {
                    $heroSynergy = Matchup::where('hero', $direHero)->where('matchup_hero', $direHeroSynergy)->first();
                    $heroSynergyRounded = round($heroSynergy->with / 4  , 2);
                    $this->teamsData['dire']['heroes'][$direHero]['synergy'][$direHeroSynergy] = $heroSynergyRounded;
                    $this->teamsData['dire']['heroes'][$direHero]['heroSynergy']  += $heroSynergyRounded;

//                    $this->teamsData['dire']['heroes'][$direHero]['points'] += $heroSynergyRounded;
//                    $this->teamsData['dire']['points'] += $heroSynergyRounded;
                    $this->teamsData['dire']['synergy'] += $heroSynergyRounded;
                }
            }
        }

        /*=========================
        Анализ синергии команды света
        =========================*/
        foreach ($this->radiantHeroes as $radiantHero) {
            $this->teamsData['radiant']['heroes'][$radiantHero]['heroSynergy'] = 0;

            foreach ($this->radiantHeroes as $radiantHeroSynergy) {
                if (!($radiantHero === $radiantHeroSynergy)) {
                    $heroSynergy = Matchup::where('hero', $radiantHero)->where('matchup_hero', $radiantHeroSynergy)->first();
                    $heroSynergyRounded = round($heroSynergy->with  / 4, 2);

                    $this->teamsData['radiant']['heroes'][$radiantHero]['synergy'][$radiantHeroSynergy] = $heroSynergyRounded;
                    $this->teamsData['radiant']['heroes'][$radiantHero]['heroSynergy']  += $heroSynergyRounded;

//                    $this->teamsData['radiant']['heroes'][$radiantHero]['points'] += $heroSynergyRounded;
//                    $this->teamsData['radiant']['points'] += $heroSynergyRounded;
                    $this->teamsData['radiant']['synergy'] += $heroSynergyRounded;
                }
            }
        }
    }
}
