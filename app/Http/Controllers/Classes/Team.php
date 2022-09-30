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
            'points' => 0
        ],
        'radiant' => [
            'heroes' => [],
            'weak' => 0,
            'points' => 0
        ]
    ];

    public function __construct($direHeroes, $radiantHeroes)
    {
        $this->direHeroes = $direHeroes;
        $this->radiantHeroes = $radiantHeroes;
    }

    public function heroPowerAnalysis()
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

                $this->teamsData['dire']['heroes'][$direHero]['points'] -= $matchup['percent'];
                $this->teamsData['dire']['points'] -= $matchup['percent'];

                if ($matchup['percent'] < 0) {
                    $this->teamsData['dire']['heroes'][$direHero]['powerPoints'] -= $matchup['percent'];
                }
                if ($matchup['percent'] > 0) {
                    $this->teamsData['dire']['weak'] += $matchup['percent'];
                    $this->teamsData['dire']['heroes'][$direHero]['weakPoints'] += $matchup['percent'];
                }
                if ($matchup['percent'] > 1.5) {
                    $this->teamsData['dire']['heroes'][$direHero]['counterPicks'][$radiantHero] = $matchup['percent'];
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

                $this->teamsData['radiant']['heroes'][$radiantHero]['points'] -= $matchup['percent'];
                $this->teamsData['radiant']['points'] -= $matchup['percent'];

                if ($matchup['percent'] < 0) {
                    $this->teamsData['radiant']['heroes'][$radiantHero]['powerPoints'] -= $matchup['percent'];
                }
                if ($matchup['percent'] > 0) {
                    $this->teamsData['radiant']['weak'] += $matchup['percent'];
                    $this->teamsData['radiant']['heroes'][$radiantHero]['weakPoints'] += $matchup['percent'];
                }
                if ($matchup['percent'] > 1.5) {
                    $this->teamsData['radiant']['heroes'][$radiantHero]['counterPicks'][$direHero] = $matchup['percent'];
                }
            }
        }
    }

    public function heroTempoAnalysis()
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
}
