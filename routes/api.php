<?php

use App\Http\Controllers\Api\V1\Admin\TourController as AdminTourController;
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

    // Tours public for user
    Route::get('/tours', [TourController::class, 'index']);
    Route::get('/tours/{id}', [TourController::class, 'show']);

    //Tours
    Route::middleware(['auth:sanctum'])->group(function () {

        // Admin tours
        Route::middleware('role:admin')->group(function () {

            Route::get('/admin/dashboard', [AdminTourController::class, 'index']);

            Route::post('tours/create', [AdminTourController::class, 'store']);
            Route::post('tours/update/{id}', [AdminTourController::class, 'update']);
            Route::delete('/tours/{id}', [AdminTourController::class, 'destroy']);
            Route::get('/tours/trashed', [AdminTourController::class, 'getAllTrashed']);
            Route::get('/tours/restore/{id}', [AdminTourController::class, 'restore']);
        });

        // Logout
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});
