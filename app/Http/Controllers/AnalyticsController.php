<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\Matchup;
use App\Models\Tempo;
use Illuminate\Http\Request;
use App\Http\Controllers\Classes\Team;


class AnalyticsController extends Controller
{
    public function index()
    {
        $heroes = Hero::all();

        return view('analytics.index', ['heroes' => $heroes]);
    }

    public function analytics(Request $request)
    {
//        dd($request->dire);
        $team = new Team($request->dire, $request->radiant);
        $team->heroPower();
        $team->heroTempo();
        $team->heroSynergy();

        return view('analytics.statistics', ['teamsData' => $team->teamsData]);
    }
}
