<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\{ DynamicFormController, DynamicFieldController};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/dynamic-field/list',[DynamicFieldController::class,'fieldList']);
    Route::post('/dynamic-field/create',[DynamicFieldController::class,'createField']);
    Route::post('/dynamic-form/create',[DynamicFormController::class,'createForm']);
    Route::post('/logout', [AuthController::class, 'logout']);
});