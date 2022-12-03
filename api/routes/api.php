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
    Route::get('temperature/show', [TemperatureController::class, 'show']);
    Route::put('temperature/update/{id}', [TemperatureController::class, 'update']);
    Route::delete('temperature/{temperature}', [TemperatureController::class, 'destroy']);

    Route::post('coin', [CoinController::class, 'coin']);
    Route::get('coin/show', [CoinController::class, 'show']);
    Route::put('coin/update/{id}', [CoinController::class, 'update']);
    Route::delete('coin/{id}', [CoinController::class, 'destroy']);
});
