<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Classes\Team;

class AnalyticsController extends Controller
{
    public function index()
    {
        $heroes = \App\Models\Hero::all();

        return view('analytics.index', ['heroes' => $heroes]);
    }

    public function analytics(Request $request)
    {
        $direTeam = new Team('dire', $request->dire);
        $radiantTeam = new Team('radiant', $request->radiant);

        $direTeam->matchupStatistics($request->radiant);
        $radiantTeam->matchupStatistics($request->dire);

        return view('analytics.statistics', ['direTeam' => $direTeam, 'radiantTeam' => $radiantTeam]);
    }
}
