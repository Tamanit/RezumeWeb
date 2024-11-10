<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index']);
Route::get('/show', [IndexController::class, 'show']);
Route::get('/stage-5-to-15', [IndexController::class, 'stageFromTo']);
Route::get('/it-guy', [IndexController::class, 'itGuy']);
Route::get('/resume-count', [IndexController::class, 'resumeCount']);
Route::get('/active-staff', [IndexController::class, 'activeStaff']);
