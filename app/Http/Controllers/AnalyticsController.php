<?php

namespace App\Http\Controllers;

use App\Models\Hero;
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
        $team = new Team($request->dire, $request->radiant);
        $team->heroPower();
        $team->heroSynergy();

        return view('analytics.statistics', ['teamsData' => $team->teamsData]);
    }
}
