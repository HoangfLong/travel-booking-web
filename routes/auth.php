<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\TourRider\TourRiderController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Google OAuth Routes
    Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])
        ->name('auth.google');
    
    Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
    
    // Facebook OAuth Routes
    Route::get('auth/facebook', [FacebookController::class, 'redirectToFacebook'])
        ->name('auth.facebook');
    
    Route::get('auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    // Route::get('verify-email', EmailVerificationPromptController::class)
    //     ->name('verification.notice');

    // Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
    //     ->middleware(['signed', 'throttle:6,1'])
    //     ->name('verification.verify');

    // Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    //     ->middleware('throttle:6,1')
    //     ->name('verification.send');

    // Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
    //     ->name('password.confirm');

    // Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    // Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    //     ->name('logout');

    Route::prefix('admin')->middleware(['role:admin'])->group(function () {
        Route::get('/dashboard',[AdminDashboardController::class, 'index'])->name('admin.dashboard');
        
        Route::prefix('/tours')->group(function () {
            Route::get('/trash', [TourController::class, 'getAllTrashed'])->name('admin.tours.trash');
            Route::post('/{id}/restore', [TourController::class, 'restore'])->name('admin.tours.restore');
            Route::delete('/{id}/force-delete', [TourController::class, 'forceDelete'])->name('admin.tours.forceDelete');
        });

        Route::prefix('/users')->group(function() {
            Route::get('/index',[UserController::class, 'index'])->name('admin.users.index');
            Route::get('/{id}/show',[UserController::class, 'show'])->name('admin.users.show');
            Route::get('/trash', [UserController::class, 'getAllTrashed'])->name('admin.users.trash');
            Route::post('/{id}/restore', [UserController::class, 'restore'])->name('admin.users.restore');
            Route::delete('/{id}/force-delete', [UserController::class, 'forceDelete'])->name('admin.users.forceDelete');
        });

        Route::prefix('/bookings')->group(function() {
            Route::get('/index', [BookingController::class, 'index'])->name('admin.bookings.index');
            Route::get('/{id}/show', [BookingController::class, 'show'])->name('admin.bookings.show');
        });

        Route::resource('/tours', TourController::class)->names([
            'index' => 'admin.tours.index',
            'create' => 'admin.tours.create',
            'store' => 'admin.tours.store',
            'edit' => 'admin.tours.edit',
            'update' => 'admin.tours.update',
            'destroy' => 'admin.tours.destroy',
            'show' => 'admin.tours.show',
        ]);;
    });    

    Route::prefix('tour_rider')->middleware(['role:tour_rider'])->group(function () {
        Route::get('/dashboard',[TourRiderController::class, 'index'])->name('tour_rider.dashboard');

        Route::resource('/tours', TourRiderController::class)->names([
            'index' => 'tour_rider.tours.index',
            'create' => 'tour_rider.tours.create',
            'store' => 'tour_rider.tours.store',
            'edit' => 'tour_rider.tours.edit',
            'update' => 'tour_rider.tours.update',
            'destroy' => 'tour_rider.tours.destroy',
            'show' => 'tour_rider.tours.show',
        ]);;
    });
});
