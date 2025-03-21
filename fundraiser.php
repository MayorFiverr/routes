<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Fundraiser\FundraiserController;

// Fundraiser API Routes
Route::middleware(['auth:sanctum', 'verified', 'activity', 'prevent-back-history'])->group(function () {

    // Fundraiser Explore
    Route::get('/fundraiser/explore', [FundraiserController::class, 'index']); // Get all fundraisers
    Route::get('/fundraiser/explore/search', [FundraiserController::class, 'search']); // Search fundraisers
    Route::get('/fundraiser/category/{type}', [FundraiserController::class, 'category']); // Get fundraisers by category

    // Campaigns by Category
    Route::get('/fundraiser/campaigns/{type}', [FundraiserController::class, 'campaign_by_category']); // Get campaigns by category

    // Fundraiser CRUD
    Route::post('/fundraiser/store', [FundraiserController::class, 'store']); // Create a fundraiser
    Route::get('/fundraiser/create', [FundraiserController::class, 'create']); // Get fundraiser creation form
    Route::get('/fundraiser/edit/{id}', [FundraiserController::class, 'edit']); // Get fundraiser edit form
    Route::post('/fundraiser/update/{id}', [FundraiserController::class, 'update']); // Update a fundraiser

    // Fundraiser Activity
    Route::get('/fundraiser/myactivity/explore/{donor?}', [FundraiserController::class, 'myactivity']); // Get fundraiser activities
    Route::get('/fundraiser/myactivity/donor/activity', [FundraiserController::class, 'donor']); // Get donor activities
    Route::get('/fundraiser/myactivity/donor/history', [FundraiserController::class, 'dhistory']); // Get donor history
    Route::get('/fundraiser/myactivity/explore/delete/{id}', [FundraiserController::class, 'explore_delete']); // Delete a fundraiser activity
    Route::get('/fundraiser/myactivity/explore/status/{id}', [FundraiserController::class, 'status']); // Update fundraiser status

    // Fundraiser Profile
    Route::get('/fundraiser/profile/{id}', [FundraiserController::class, 'profile']); // Get fundraiser profile
    Route::get('/fundraiser/donate/modal/{id}', [FundraiserController::class, 'donate_modal']); // Get donation modal
    Route::post('/fundraiser/donate/store', [FundraiserController::class, 'donate_modal_store']); // Store donation

    // Payment Routes
    Route::get('/fundraiser/myactivity/campaign/payment/history/{type}', [FundraiserController::class, 'campaign_history']); // Get campaign payment history
    Route::get('/fundraiser/myactivity/payment/history', [FundraiserController::class, 'phistory']); // Get payment history
    Route::get('/fundraiser/myactivity/payment/history/model/{id}', [FundraiserController::class, 'phistory_model']); // Get payment history modal
    Route::get('/test', [FundraiserController::class, 'test']); // Test route

    // Campaign Payout
    Route::post('/fundraiser/myactivity/campaign/payout', [FundraiserController::class, 'campaign_payout']); // Request campaign payout

    // Campaign Type
    Route::get('/fundraiser/myactivity/campaign/{type}', [FundraiserController::class, 'campaign_type']); // Get campaigns by type
    Route::get('/fundraiser/myactivity/campaign/payment/cancel/{id}', [FundraiserController::class, 'campaign_cancel']); // Cancel campaign payment

    // Share Fundraiser
    Route::any('/fundraiser/profile/share', [FundraiserController::class, 'share_modal']); // Share fundraiser modal

    // Invited Friends
    Route::get('/fundraiser/profile/invite/{invited_friend_id}/{requester_id}/{fundraiser_id}', [FundraiserController::class, 'invited']); // Invite friends to fundraiser
    Route::get('/fundraiser/profile/see/all/friends/{type}/{id}', [FundraiserController::class, 'see_more_friend']); // See more friends
    Route::post('/fundraiser/invites/sent', [FundraiserController::class, 'sent_invition']); // Send invites

    // Share on Timeline
    Route::post('/fundraiser/share/on/my/timeline', [FundraiserController::class, 'share_my_timeline']); // Share fundraiser on timeline

    // Backend Routes
    Route::get('/admin/fundraiser/payment/success', [FundraiserController::class, 'payout_report']); // Get successful payouts
    Route::get('/admin/fundraiser/payment/pending', [FundraiserController::class, 'pending_report']); // Get pending payouts
    Route::get('/admin/fundraiser/payment/pending/delete/{id}', [FundraiserController::class, 'delete_payout']); // Delete pending payout
    Route::get('/admin/fundraiser/payment/pending/accept/{id}', [FundraiserController::class, 'author_payout']); // Accept pending payout
});