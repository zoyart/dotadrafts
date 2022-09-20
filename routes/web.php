<?php

use App\Http\Controllers\Parse\ParseController;
use App\Http\Controllers\AnalyticsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AnalyticsController::class, 'index'])->name('index');
Route::get('/analytics', [AnalyticsController::class, 'analytics'])->name('analytics');

Route::get('/parse-matchups', [ParseController::class, 'matchups'])->name('parse.matchups');


