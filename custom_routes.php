<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminCrudController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PaymentHistory;
use App\Http\Controllers\PaidContent;

// Admin Product Brand Routes
Route::middleware(['auth:sanctum', 'verified', 'admin', 'prevent-back-history'])->group(function () {
    Route::get('/admin/product/brand/create', [AdminCrudController::class, 'create_brand_category']); // Get brand creation form
    Route::post('/admin/product/brand/save', [AdminCrudController::class, 'save_brand_category']); // Save brand
    Route::get('/admin/product/brand/edit/{id}', [AdminCrudController::class, 'edit_brand_category']); // Get brand edit form
    Route::post('/admin/product/brand/update/{id}', [AdminCrudController::class, 'update_brand_category']); // Update brand
    Route::get('/admin/product/brand/delete/{id}', [AdminCrudController::class, 'delete_brand_category']); // Delete brand
});

// Admin Blog Category Routes
Route::middleware(['auth:sanctum', 'verified', 'admin', 'prevent-back-history'])->group(function () {
    Route::get('/admin/blog/category/view', [AdminCrudController::class, 'view_blog_category']); // View blog categories
    Route::get('/admin/blog/category/create', [AdminCrudController::class, 'create_blog_category']); // Get blog category creation form
    Route::post('/admin/blog/category/save', [AdminCrudController::class, 'save_blog_category']); // Save blog category
    Route::get('/admin/blog/category/edit/{id}', [AdminCrudController::class, 'edit_blog_category']); // Get blog category edit form
    Route::post('/admin/blog/category/update/{id}', [AdminCrudController::class, 'update_blog_category']); // Update blog category
    Route::get('/admin/blog/category/delete/{id}', [AdminCrudController::class, 'delete_blog_category']); // Delete blog category
});

// Admin Payment Settings Routes
Route::middleware(['auth:sanctum', 'verified', 'admin', 'prevent-back-history'])->group(function () {
    Route::get('/admin/settings/payment', [AdminCrudController::class, 'payment_settings']); // Get payment settings
    Route::get('/admin/payment_gateway/edit/{id}', [AdminCrudController::class, 'payment_gateway_edit']); // Get payment gateway edit form
    Route::post('/admin/payment_gateway/update/{id}', [AdminCrudController::class, 'payment_gateway_update']); // Update payment gateway
    Route::get('/admin/payment_gateway/status/{id}', [AdminCrudController::class, 'payment_gateway_status']); // Update payment gateway status
    Route::get('/admin/payment_gateway/environment/{id}', [AdminCrudController::class, 'payment_gateway_environment']); // Update payment gateway environment
});

// Admin System About Routes
Route::middleware(['auth:sanctum', 'verified', 'admin', 'prevent-back-history'])->group(function () {
    Route::get('/admin/settings/about', [AdminCrudController::class, 'about']); // Get system about settings
    Route::any('/admin/save_valid_purchase_code/{action_type?}', [AdminCrudController::class, 'save_valid_purchase_code']); // Save valid purchase code
});

// Sponsor Routes
Route::middleware(['auth:sanctum', 'verified', 'admin', 'prevent-back-history'])->group(function () {
    Route::get('/admin/sponsor/view', [SponsorController::class, 'view_sponsor']); // View sponsors
    Route::get('/admin/sponsor/create', [SponsorController::class, 'create_sponsor']); // Get sponsor creation form
    Route::post('/admin/sponsor/save', [SponsorController::class, 'save_sponsor']); // Save sponsor
    Route::get('/admin/sponsor/edit/{id}', [SponsorController::class, 'edit_sponsor']); // Get sponsor edit form
    Route::post('/admin/sponsor/update/{id}', [SponsorController::class, 'update_sponsor']); // Update sponsor
    Route::get('/admin/sponsor/delete/{id}', [SponsorController::class, 'delete_sponsor']); // Delete sponsor
});

// Notification Routes
Route::middleware(['auth:sanctum', 'verified', 'activity'])->group(function () {
    Route::get('/all/notification', [NotificationController::class, 'notifications']); // Get all notifications
    Route::get('/accept/friend/request/notification/{id}', [NotificationController::class, 'accept_friend_notification']); // Accept friend request notification
    Route::get('/decline/friend/request/notification/{id}', [NotificationController::class, 'decline_friend_notification']); // Decline friend request notification
    Route::get('/accept/group/request/notification/{id}/{group_id}', [NotificationController::class, 'accept_group_notification']); // Accept group request notification
    Route::get('/decline/group/request/notification/{id}/{group_id}', [NotificationController::class, 'decline_group_notification']); // Decline group request notification
    Route::get('/accept/event/request/notification/{id}/{event_id}', [NotificationController::class, 'accept_event_notification']); // Accept event request notification
    Route::get('/decline/event/request/notification/{id}/{event_id}', [NotificationController::class, 'decline_event_notification']); // Decline event request notification
    Route::get('/mark/as/read/notification/{id}', [NotificationController::class, 'mark_as_read']); // Mark notification as read
    Route::get('/accept/fundraiser/request/notification/{id}/{fundraiser_id}', [NotificationController::class, 'accept_fundraiser_notification']); // Accept fundraiser request notification
    Route::get('/decline/fundraiser/request/notification/{id}/{fundraiser_id}', [NotificationController::class, 'decline_fundraiser_notification']); // Decline fundraiser request notification
});

// Language Routes
Route::middleware(['auth:sanctum', 'verified', 'activity', 'admin'])->group(function () {
    Route::get('/admin/all/language/settings', [LanguageController::class, 'language']); // Get language settings
    Route::post('/admin/create/language', [LanguageController::class, 'language_add']); // Create language
    Route::post('/admin/languages/update/{language}', [LanguageController::class, 'language_update']); // Update language
    Route::get('/admin/languages/edit/phrase/{language}', [LanguageController::class, 'edit_phrase']); // Edit phrase
    Route::post('/admin/languages/update/phrase/{id}', [LanguageController::class, 'update_phrase']); // Update phrase
});

// Payment History Routes
Route::middleware(['auth:sanctum', 'verified', 'activity', 'admin', 'prevent-back-history'])->group(function () {
    Route::get('/admin/payment-histories', [PaymentHistory::class, 'index']); // Get payment histories
});

// Paid Content Routes
Route::middleware(['auth:sanctum', 'verified', 'activity', 'prevent-back-history'])->group(function () {
    Route::get('/paid/content', [PaidContent::class, 'paid_content']); // Get paid content
    Route::get('/paid/content/general/timeline', [PaidContent::class, 'general_timeline']); // Get general timeline
    Route::get('/creator/payout', [PaidContent::class, 'creator_payout']); // Get creator payout
    Route::post('/creator/payout/request', [PaidContent::class, 'creator_payout_request']); // Request creator payout
    Route::get('/creator/payout/cancel/{id}', [PaidContent::class, 'creator_payout_cancel']); // Cancel creator payout
    Route::get('/paid/content/subscriber', [PaidContent::class, 'subscriber_list']); // Get subscriber list
    Route::get('/user/subscription', [PaidContent::class, 'user_subscription']); // Get user subscription
    Route::get('/subscription/payment', [PaidContent::class, 'subscription_payment']); // Get subscription payment
    Route::get('/paid/content/view/{page}/{id}', [PaidContent::class, 'creator_page_view']); // View creator page
    Route::post('/paid/content/request/author/{id}', [PaidContent::class, 'request_author']); // Request author
    Route::post('/paid/content/subscription/payment/{id}', [PaidContent::class, 'subscription']); // Subscription payment configuration
    Route::post('/paid/content/search/{type}', [PaidContent::class, 'search_type']); // Search content by type
    Route::get('/paid/content/search/{type}', [PaidContent::class, 'search_type']); // Search content by type
    Route::get('/load/searched/list/item', [PaidContent::class, 'load_search_list_item']); // Load searched list items
    Route::get('/paid/content/creator/{type}', [PaidContent::class, 'creator_timeline']); // Get creator timeline
    Route::get('/creator/post/type/{type}', [PaidContent::class, 'creator_timeline']); // Get creator posts by type
    Route::get('/creator/subscribers', [PaidContent::class, 'subscribers']); // Get creator subscribers
    Route::get('/creator/packages', [PaidContent::class, 'packages']); // Get creator packages
    Route::post('/paid/content/create/package', [PaidContent::class, 'create_package']); // Create package
    Route::get('/paid/content/package/edit/{id}', [PaidContent::class, 'edit_package']); // Edit package
    Route::post('/paid/content/package/update/{id}', [PaidContent::class, 'update_package']); // Update package
    Route::get('/paid/content/package/delete/{id}', [PaidContent::class, 'delete_package']); // Delete package
    Route::get('/paid/content/settings', [PaidContent::class, 'settings']); // Get settings
    Route::post('/paid/content/settings/update/{id}', [PaidContent::class, 'update_settings']); // Update settings
    Route::get('/paid/content/settings/remove/{type}', [PaidContent::class, 'remove_photo']); // Remove photo
    Route::post('/paid/content/my_page/post', [PaidContent::class, 'post']); // Create post
    Route::get('/load/paid/content/post', [PaidContent::class, 'load_paid_content_post']); // Load paid content posts
    Route::get('/load/timeline/post', [PaidContent::class, 'load_timeline_post']); // Load timeline posts
    Route::get('/admin/author/list', [PaidContent::class, 'author_list']); // Get author list
    Route::get('/admin/author/status/{id}', [PaidContent::class, 'author_status']); // Update author status
    Route::get('/admin/author/delete/{id}', [PaidContent::class, 'author_delete']); // Delete author
    Route::get('/admin/author/review/request/{id}', [PaidContent::class, 'review_request']); // Review author request
    Route::get('/admin/author/payout', [PaidContent::class, 'payout_report']); // Get payout report
    Route::get('/admin/author/pending/report', [PaidContent::class, 'pending_report']); // Get pending report
    Route::get('/admin/make/payment/{id}', [PaidContent::class, 'author_payout']); // Make author payout
    Route::get('/admin/payout/delete/{id}', [PaidContent::class, 'delete_payout']); // Delete payout
});