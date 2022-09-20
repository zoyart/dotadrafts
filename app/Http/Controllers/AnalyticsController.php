<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index() {
        return view('analytics.index');
    }

    public function analytics(Request $request) {
        $dire = 1;
        $radiant = 1;

        return 1;
    }
}
