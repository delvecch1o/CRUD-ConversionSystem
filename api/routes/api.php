<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TemperatureController;
use App\Http\Controllers\API\CoinController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('temperature', [TemperatureController::class, 'temperature']);
    Route::post('coin', [CoinController::class, 'coin']);
    
});

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

*/