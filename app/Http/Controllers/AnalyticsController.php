<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index() {
        $heroes = Hero::all();

        return view('analytics.index', ['heroes' => $heroes]);
    }

    public function analytics(Request $request) {
        dd($request);
        $dire = 1;
        $radiant = 1;

        return view('analytics.statistics', ['req' => $request->all()]);
    }
}
