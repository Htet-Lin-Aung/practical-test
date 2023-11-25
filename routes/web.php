<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[SurveyController::class,'list'])->name('home');

Route::get('/survey/create/{form}',[SurveyController::class,'create'])->name('survey.create');
Route::post('/survey/store/{form}',[SurveyController::class,'store'])->name('survey.store');
