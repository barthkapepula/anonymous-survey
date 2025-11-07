<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;

Route::get('/', [SurveyController::class, 'index'])->name('survey.form');
Route::post('/survey/submit', [SurveyController::class, 'submit'])->name('survey.submit');
