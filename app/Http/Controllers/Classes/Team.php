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
                    $this->teamsData['dire']['heroes'][$direHero]['counterPicks'][] = "{$radiantHero} ({$matchup['percent']})";
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
                if ($matchup['percent'] > 2) {
                    $this->teamsData['radiant']['heroes'][$radiantHero]['counterPicks'][] = "{$direHero} ({$matchup['percent']})";
                }
            }
        }
    }

    public function heroTempoAnalysis()
    {
        // Анализ темпа команды тьмы
        foreach ($this->direHeroes as $direHero) {
            $heroTempo = Tempo::where('hero_name', $direHero)->first();

            $this->teamsData['dire']['heroes'][$direHero]['tempo'] = [
                'heroName' => $heroTempo->hero_name,
                'matches' => $heroTempo->matches,
                'earlyDuration' => $heroTempo->early_duration,
                'middleDuration' => $heroTempo->middle_duration,
                'lateDuration' => $heroTempo->late_duration,
                'earlyWinrate' => $heroTempo->early_winrate,
                'middleWinrate' => $heroTempo->middle_winrate,
                'lateWinrate' => $heroTempo->late_winrate,
                'gradient' => $heroTempo->gradient,
            ];
        }

        // Анализ темпа команды света
        foreach ($this->radiantHeroes as $radiantHero) {
            $heroTempo = Tempo::where('hero_name', $radiantHero)->first();

            $this->teamsData['radiant']['heroes'][$radiantHero]['tempo'] = [
                'heroName' => $heroTempo->hero_name,
                'matches' => $heroTempo->matches,
                'earlyDuration' => $heroTempo->early_duration,
                'middleDuration' => $heroTempo->middle_duration,
                'lateDuration' => $heroTempo->late_duration,
                'earlyWinrate' => $heroTempo->early_winrate,
                'middleWinrate' => $heroTempo->middle_winrate,
                'lateWinrate' => $heroTempo->late_winrate,
                'gradient' => $heroTempo->gradient,
            ];
        }
    }
}
