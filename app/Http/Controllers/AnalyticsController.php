<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\Matchup;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index()
    {
        $heroes = Hero::all();

        return view('analytics.index', ['heroes' => $heroes]);
    }

    public function analytics(Request $request)
    {
        $dire = $request->dire;
        $radiant = $request->radiant;
        $heroPointsCounter = 0;
        $heroWeakCounter = 0;

        // Подсчет слабости у команды тьмы
        $direWeak = 0;
        $direCounterPick = array();
        $direHeroesPoints = array();
        $direHeroesWeak = array();

        foreach ($dire as $direHero) {
            foreach ($radiant as $radiantHero) {
                $matchup = Matchup::where('hero', $direHero)->where('matchup_hero', $radiantHero)->first();
                $direWeak -= $matchup['percent'];
                $heroPointsCounter -= $matchup['percent'];

                if ($matchup['percent'] > 0) {
                    $heroWeakCounter += $matchup['percent'];
                }
                if ($matchup['percent'] > 1.5) {
                    $direCounterPick[$direHero] =  "{$radiantHero} ({$matchup['percent']})";
                }
            }
            $direHeroesPoints[$direHero] = $heroPointsCounter; // Добавление общих очков герою
            $direHeroesWeak[$direHero] = $heroWeakCounter;
            $heroPointsCounter = 0;
            $heroWeakCounter = 0;
        }

        // Подсчет слабости у команды света
        $radiantWeak = 0;
        $radiantCounterPick = array();
        $radiantHeroesPoints = array();
        $radiantHeroesWeak = array();

        foreach ($radiant as $radiantHero) {
            foreach ($dire as $direHero) {
                $matchup = Matchup::where('hero', $radiantHero)->where('matchup_hero', $direHero)->first();
                $radiantWeak -= $matchup['percent'];
                $heroPointsCounter -= $matchup['percent'];

                if ($matchup['percent'] > 0) {
                    $heroWeakCounter += $matchup['percent'];
                }
                if ($matchup['percent'] > 1.5) {
                    $radiantCounterPick[$radiantHero] = "{$direHero} ({$matchup['percent']})";;
                }
            }
            $radiantHeroesPoints[$radiantHero] = $heroPointsCounter;
            $radiantHeroesWeak[$radiantHero] = $heroWeakCounter;
            $heroPointsCounter = 0;
            $heroWeakCounter = 0;
        }

        return view('analytics.statistics', [
            'dire' => $dire,
            'direWeak' => $direWeak,
            'direCounterPick' => $direCounterPick,
            'direHeroesWeak' => $direHeroesWeak,
            'direHeroesPoints' => $direHeroesPoints,
            'radiant' => $radiant,
            'radiantWeak' => $radiantWeak,
            'radiantCounterPick' => $radiantCounterPick,
            'radiantHeroesWeak' => $radiantHeroesWeak,
            'radiantHeroesPoints' => $radiantHeroesPoints,
        ]);
    }
}
