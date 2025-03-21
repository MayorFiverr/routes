<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    // Guest routes (unauthenticated users)
    Route::middleware('guest')->group(function () {
        // Registration
        Route::post('register', [RegisteredUserController::class, 'store']);

        // Login
        Route::post('login', [AuthenticatedSessionController::class, 'store']);

        // Password Reset
        Route::post('forgot-password', [PasswordResetLinkController::class, 'store']);
        Route::post('reset-password', [NewPasswordController::class, 'store']);
    });

    // Authenticated routes
    Route::middleware('auth:api')->group(function () {
        // Email Verification
        Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
            ->name('verification.verify');
            
        Route::post('email/verification', [EmailVerificationNotificationController::class, 'store']);

        // Password Confirmation
        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

        // Logout
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy']);
    });
});