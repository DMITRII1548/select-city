<?php

use App\Http\Controllers\CityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/cities/{city}/prefix", [CityController::class, 'getCityByPrefix']);
Route::get('/cities/{city}', [CityController::class, 'show']);
