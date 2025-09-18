<?php

use App\Http\Controllers\Api\V1\Admin\AdminDashboardController;
use App\Http\Controllers\Api\V1\Admin\BookingController;
use App\Http\Controllers\Api\V1\Admin\TourController as AdminTourController;
use App\Http\Controllers\Api\V1\Admin\UserController;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Auth\VerificationController;
use App\Http\Controllers\Api\V1\Auth\VerifyEmailController;
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

            Route::get('/tours/index', [AdminTourController::class, 'index']);
            Route::post('tours/create', [AdminTourController::class, 'store']);
            Route::post('tours/update/{id}', [AdminTourController::class, 'update']);
            Route::delete('/tours/{id}', [AdminTourController::class, 'destroy']);
            Route::get('/tours/trashed', [AdminTourController::class, 'getAllTrashed']);
            Route::get('/tours/restore/{id}', [AdminTourController::class, 'restore']);
        });

        // Logout
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index']);

    Route::get('users/management', [UserController::class, 'index']);
    Route::get('users/management/{id}', [UserController::class, 'show']);

    Route::get('/bookings', [BookingController::class, 'index']);
    Route::get('/bookings/{id}', [BookingController::class, 'show']);

    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    Route::get('/verify-email/{id}/{hash}', [VerificationController::class, 'verify'])
        ->middleware(['signed'])
        ->name('verification.verify');
    Route::post('/email/resend', [VerificationController::class, 'resend'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
});
