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
        $direHeroes = $request->dire;
        $radiantHeroes = $request->radiant;

        $heroPointsCounter = 0;
        $heroWeakCounter = 0;
        $heroPowerCounter = 0;

        // Подсчет слабости у команды тьмы
        $direData = array();
        $direWeak = 0;

        foreach ($direHeroes as $direHero) {
            foreach ($radiantHeroes as $radiantHero) {
                $matchup = Matchup::where('hero', $direHero)->where('matchup_hero', $radiantHero)->first();
                $direWeak -= $matchup['percent'];
                $heroPointsCounter -= $matchup['percent'];

                if ($matchup['percent'] < 0) $heroPowerCounter -= $matchup['percent'];
                if ($matchup['percent'] > 0) $heroWeakCounter += $matchup['percent'];
                if ($matchup['percent'] > 1.5) $direData[$direHero]['counterPicks'][] =  "{$radiantHero} ({$matchup['percent']})";
            }

            // Запись информации о текущем герое в массив
            $direData[$direHero]['heroPoints'] = $heroPointsCounter;
            $direData[$direHero]['heroWeak'] = $heroWeakCounter;
            $direData[$direHero]['heroPower'] = $heroPowerCounter;

            // Обновление счётчиков
            $heroPowerCounter = 0;
            $heroPointsCounter = 0;
            $heroWeakCounter = 0;
        }

        // Подсчет слабости у команды света
        $radiantData = array();
        $radiantWeak = 0;

        foreach ($radiantHeroes as $radiantHero) {
            foreach ($direHeroes as $direHero) {
                $matchup = Matchup::where('hero', $radiantHero)->where('matchup_hero', $direHero)->first();
                $radiantWeak -= $matchup['percent'];
                $heroPointsCounter -= $matchup['percent'];

                if ($matchup['percent'] < 0) $heroPowerCounter -= $matchup['percent'];
                if ($matchup['percent'] > 0) $heroWeakCounter += $matchup['percent'];
                if ($matchup['percent'] > 1.5) $direData[$radiantHero]['counterPicks'][] = "{$direHero} ({$matchup['percent']})";
            }

            // Запись информации о текущем герое в словари
            $radiantData[$radiantHero]['heroPoints'] = $heroPointsCounter;
            $radiantData[$radiantHero]['heroWeak'] = $heroWeakCounter;
            $radiantData[$radiantHero]['heroPower'] = $heroPowerCounter;

            // Обновление счётчиков
            $heroPointsCounter = 0;
            $heroWeakCounter = 0;
            $heroPowerCounter = 0;
        }
//        dd($direData);
        return view('analytics.statistics', [
            'direHeroes' => $direHeroes,
            'direData' => $direData,
            'direWeak' => $direWeak,

            'radiantHeroes' => $radiantHeroes,
            'radiantData' => $radiantData,
            'radiantWeak' => $radiantWeak,
        ]);
    }
}
