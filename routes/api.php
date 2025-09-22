<?php

use App\Http\Controllers\Api\V1\Admin\AdminDashboardController;
use App\Http\Controllers\Api\V1\Admin\UserController;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Auth\VerificationController;
use App\Http\Controllers\Api\V1\Auth\VerifyEmailController;
use App\Http\Controllers\Api\V1\BookingController;
use App\Http\Controllers\Api\V1\PaymentController;
use App\Http\Controllers\Api\V1\ProfileController;
use App\Http\Controllers\Api\V1\TourController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {

    // Login, Register
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/verify-email/{id}/{hash}', [VerificationController::class, 'verify'])
        ->middleware(['signed'])
        ->name('verification.verify');
    Route::post('/email/resend', [VerificationController::class, 'resend'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    // Tours public for user
    Route::get('/tours', [TourController::class, 'index']);
    Route::get('/tours/{id}', [TourController::class, 'show']);

    //Tours
    Route::middleware(['auth:sanctum'])->group(function () {

        // Admin tours
        Route::middleware('role:admin')->prefix('admin')->group(function () {

            Route::get('/dashboard', [AdminDashboardController::class, 'index']);
            Route::get('/tours/index', [TourController::class, 'index']);
            Route::get('tours/{id}', [TourController::class, 'show']);
            Route::post('tours/create', [TourController::class, 'store']);
            Route::post('tours/update/{id}', [TourController::class, 'update']);
            Route::delete('/tours/{id}', [TourController::class, 'destroy']);

            // Trash Management
            Route::get('/tours/force/{id}', [TourController::class, 'forceDelete']);
            Route::get('/tours/trashed', [TourController::class, 'getAllTrashed']);
            Route::get('/tours/restore/{id}', [TourController::class, 'restore']);

            // Bookings
            Route::get('/bookings', [BookingController::class, 'index']);
            Route::get('/bookings/{id}', [BookingController::class, 'show']);

            // Users management
            Route::get('users/management', [UserController::class, 'index']);
            Route::get('users/management/{id}', [UserController::class, 'show']);
        });

        // User
        Route::middleware('role:user')->prefix('user')->group(function () {

            Route::get('/profile', [ProfileController::class, 'show']);
            Route::put('/profile', [ProfileController::class, 'update']);
            Route::delete('/profile', [ProfileController::class, 'destroy']);

            Route::get('/bookings', [BookingController::class, 'index']);
            Route::get('/bookings/{id}', [BookingController::class, 'show']);
        });

        Route::post('/payments/checkout/{tourId}', [PaymentController::class, 'checkout']);
        Route::post('/payments/success', [PaymentController::class, 'success']);
        Route::post('/payments/cancel/{tourId}', [PaymentController::class, 'cancel']);

        // Logout
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});
