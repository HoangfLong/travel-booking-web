<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\TourController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    //Tours
    Route::get('/tours/trashed', [TourController::class, 'getAllTrashed']);
    Route::post('tours/create', [TourController::class, 'store']);
    Route::post('tours/update/{id}', [TourController::class, 'update']);
    Route::get('/tours', [TourController::class, 'index']);
    Route::get('/tours/{id}', [TourController::class, 'show']);
    Route::delete('/tours/{id}', [TourController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});
