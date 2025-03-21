<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PaymentController;

// API v1 Payment Routes
Route::prefix('v1')->middleware(['auth:sanctum', 'verified'])->group(function () {

    // Payment Resource
    Route::apiResource('payments', PaymentController::class)->only(['index', 'store']);
    
    // Payment Gateway Endpoints
    Route::prefix('payments/{payment}')->group(function () {
        // Payment Gateway Selection
        Route::get('gateways', [PaymentController::class, 'showGateways'])
            ->name('payments.gateways');

        // Payment Processing
        Route::post('process', [PaymentController::class, 'processPayment'])
            ->name('payments.process');

        // Payment Status
        Route::get('status', [PaymentController::class, 'paymentStatus'])
            ->name('payments.status');

        // Gateway-specific Endpoints
        Route::prefix('gateways')->group(function () {
            // Razorpay
            Route::post('razorpay/order', [PaymentController::class, 'createRazorpayOrder'])
                ->name('payments.razorpay.order');

            // Paytm
            Route::post('paytm/order', [PaymentController::class, 'createPaytmOrder'])
                ->name('payments.paytm.order');
            Route::get('paytm/callback', [PaymentController::class, 'paytmCallback'])
                ->name('payments.paytm.callback');

            // Paystack
            Route::post('paystack/charge', [PaymentController::class, 'chargePaystack'])
                ->name('payments.paystack.charge');
        });
    });

    // Payment Success Webhook (public endpoint)
    Route::post('payments/webhook/{gateway}', [PaymentController::class, 'handleWebhook'])
        ->withoutMiddleware(['auth:sanctum', 'verified'])
        ->name('payments.webhook');
});