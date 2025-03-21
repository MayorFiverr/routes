<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentHistory;

// User API Routes
Route::middleware(['auth:sanctum', 'verified', 'activity', 'prevent-back-history'])->group(function () {

    // User Dashboard
    Route::get('/user/dashboard', [UserController::class, 'dashboard']); // Get user dashboard

    // User Ads
    Route::get('/user/ads', [UserController::class, 'ads']); // Get user ads
    Route::get('/user/ad/create', [UserController::class, 'ad_create']); // Get ad creation form
    Route::post('/user/ad/store', [UserController::class, 'ad_store']); // Store ad
    Route::get('/user/ad/edit/{id}', [UserController::class, 'ad_edit']); // Get ad edit form
    Route::post('/user/ad/update/{id}', [UserController::class, 'ad_update']); // Update ad
    Route::get('/user/ad/delete/{id}', [UserController::class, 'ad_delete']); // Delete ad
    Route::get('/user/ad/ad_charge_by_daterange', [UserController::class, 'ad_charge_by_daterange']); // Get ad charge by date range
    Route::post('/user/ad/payment_configuration/{id}', [UserController::class, 'payment_configuration']); // Configure payment for ad
    Route::get('/user/ad/payment_success/{identifier}', [UserController::class, 'payment_success']); // Handle payment success
});

// Payment History API Routes
Route::middleware(['auth:sanctum', 'verified', 'activity', 'prevent-back-history'])->group(function () {
    Route::get('/user/payment-histories', [PaymentHistory::class, 'index']); // Get payment histories
});