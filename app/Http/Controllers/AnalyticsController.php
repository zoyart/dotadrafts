<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Classes\Team;
use App\Http\Controllers\Classes\Hero;

class AnalyticsController extends Controller
{
    public function index()
    {
        $heroes = \App\Models\Hero::all();

        return view('analytics.index', ['heroes' => $heroes]);
    }

    public function analytics(Request $request)
    {
        $direHeroes = [];
        $radiantHeroes = [];

        foreach ($request->dire as $hero => $feature) {
            $direHeroes[] = new Hero($hero);
        }

        foreach ($request->radiant as $hero => $feature) {
            $radiantHeroes[] = new Hero($hero);
        }

        $direTeam = new Team('dire', $direHeroes);
        $radiantTeam = new Team('radiant', $radiantHeroes);

        $direTeam->matchupStatistics($radiantHeroes);
        $radiantTeam->matchupStatistics($direHeroes);

        return view('analytics.statistics', ['direTeam' => $direTeam, 'radiantTeam' => $radiantTeam]);
    }
}
