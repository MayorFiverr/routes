<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstallController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MemoriesController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\ModalController;
use App\Http\Controllers\Profile;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\Updater;
use App\Models\Account_active_request;

// API Routes Group
Route::middleware(['auth:sanctum', 'verified', 'activity', 'prevent-back-history'])->group(function () {

    // Clear Cache
    Route::get('/clear-cache', function () {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        return response()->json(['message' => 'Application cache cleared']);
    });

    // Auth Checker
    Route::get('/auth-checker', function () {
        return response()->json(['authenticated' => auth()->check()]);
    });

    // Language Switch
    Route::get('/language/switch/{language}', function (Request $request, $language) {
        $request->session()->put('active_language', $language);
        return response()->json(['message' => 'Language switched to ' . $language]);
    })->name('language.switch');

    // Account Disable
    Route::get('/account-disable', function () {
        return response()->json(['message' => 'Account disabled']);
    });

    // Account Enable Request
    Route::get('/account-enable-req/{id}', function ($id) {
        $data = [
            'user_id' => $id,
            'status' => 'pending',
        ];
        Account_active_request::create($data);
        return response()->json(['message' => 'Account enable request submitted']);
    });

    // Modal Controller
    Route::prefix('modal')->group(function () {
        Route::any('/load-content/{view_path}', [ModalController::class, 'common_view_function']);
    });

    // Main Controller
    Route::prefix('main')->group(function () {
        Route::get('/', [MainController::class, 'timeline']);
        Route::post('/create-post', [MainController::class, 'create_post']);
        Route::get('/edit-post-form/{id}', [MainController::class, 'edit_post_form']);
        Route::post('/edit-post/{id}', [MainController::class, 'edit_post']);
        Route::get('/load-post-by-scrolling', [MainController::class, 'load_post_by_scrolling']);
        Route::post('/my-react', [MainController::class, 'my_react']);
        Route::get('/my-comment-react', [MainController::class, 'my_comment_react']);
        Route::get('/post-comment', [MainController::class, 'post_comment']);
        Route::get('/load-post-comments', [MainController::class, 'load_post_comments']);
        Route::get('/search-friends-for-tagging', [MainController::class, 'search_friends_for_tagging']);
        Route::get('/save-post/{id}', [MainController::class, 'save_post']);
        Route::get('/unsave-post/{id}', [MainController::class, 'unsave_post']);
        Route::get('/live/{post_id}', [MainController::class, 'live']);
        Route::get('/live-ended/{post_id}', [MainController::class, 'live_ended']);
        Route::get('/view/single-post/{id?}', [MainController::class, 'single_post']);
        Route::get('/preview-post', [MainController::class, 'preview_post']);
        Route::get('/post-comment-count', [MainController::class, 'post_comment_count']);
        Route::post('/post/report/save', [MainController::class, 'save_post_report']);
        Route::get('/delete/my-post', [MainController::class, 'post_delete']);
        Route::get('/comment/delete', [MainController::class, 'comment_delete']);
        Route::post('/share/on/group', [MainController::class, 'share_group']);
        Route::post('/share/on/my-timeline', [MainController::class, 'share_my_timeline']);
        Route::get('/custom/shared-post/view/{id}', [MainController::class, 'custom_shared_post_view']);
        Route::get('/media/file/delete/{id}', [MainController::class, 'delete_media_file']);
        Route::get('/addons/manager', [MainController::class, 'addons_manager']);
        Route::get('/user/settings', [MainController::class, 'user_settings']);
        Route::post('/save/user/settings', [MainController::class, 'save_user_settings']);
        Route::get('/streaming/live/{id}', [MainController::class, 'live_streaming']);
        Route::post('/update-theme-color', [MainController::class, 'updateThemeColor']);
        Route::get('/album/details/page-show/{id}', [MainController::class, 'details_album']);
        Route::get('/block-user/{id}', [MainController::class, 'block_user']);
        Route::post('/block-user-post/{id}', [MainController::class, 'block_user_post']);
        Route::get('/unblock-user/{id}', [MainController::class, 'unblock_user']);
        Route::get('/ai/image-generator', [MainController::class, 'imageGenerator']);
    });

    // Memories Controller
    Route::prefix('memories')->group(function () {
        Route::get('/', [MemoriesController::class, 'memories']);
        Route::get('/load', [MemoriesController::class, 'load_memories']);
    });

    // Badge Controller
    Route::prefix('badge')->group(function () {
        Route::get('/', [BadgeController::class, 'badge']);
        Route::get('/info', [BadgeController::class, 'badge_info']);
        Route::post('/payment-configuration/{id}', [BadgeController::class, 'payment_configuration']);
    });

    // Story Controller
    Route::prefix('stories')->group(function () {
        Route::post('/create', [StoryController::class, 'create_story']);
        Route::get('/{offset?}/{limit?}', [StoryController::class, 'stories']);
        Route::get('/details/{story_id}/{offset?}/{limit?}', [StoryController::class, 'story_details']);
        Route::get('/single-details/{story_id}', [StoryController::class, 'single_story_details']);
    });

    // Profile Controller
    Route::prefix('profile')->group(function () {
        Route::get('/', [Profile::class, 'profile']);
        Route::get('/load-post-by-scrolling', [Profile::class, 'load_post_by_scrolling']);
        Route::get('/friends', [Profile::class, 'friends']);
        Route::get('/photos', [Profile::class, 'photos']);
        Route::get('/load-photos', [Profile::class, 'load_photos']);
        Route::any('/album/{action_type?}', [Profile::class, 'album']);
        Route::get('/load-albums', [Profile::class, 'load_albums']);
        Route::get('/videos', [Profile::class, 'videos']);
        Route::get('/load-videos', [Profile::class, 'load_videos']);
        Route::get('/load-my-friends', [Profile::class, 'load_my_friends']);
        Route::get('/load-my-friend-requests', [Profile::class, 'load_my_friend_requests']);
        Route::post('/accept-friend-request', [Profile::class, 'accept_friend_request']);
        Route::get('/delete-friend-request', [Profile::class, 'delete_friend_request']);
        Route::post('/about/{action_type?}', [Profile::class, 'about']);
        Route::any('/my-info/{action_type?}', [Profile::class, 'my_info']);
        Route::get('/load-photo-and-videos', [Profile::class, 'load_photo_and_videos']);
        Route::post('/upload-photo/{photo_type}', [Profile::class, 'upload_photo']);
        Route::post('/update-profile', [Profile::class, 'update_profile']);
        Route::get('/save-post-list', [Profile::class, 'savePostList']);
        Route::get('/profile-lock', [Profile::class, 'profileLock']);
        Route::get('/profile-unlock', [Profile::class, 'profileUnlock']);
        Route::get('/check-ins', [Profile::class, 'checkinsView']);
    });

    // Updater Controller
    Route::prefix('updater')->group(function () {
        Route::post('/addon/create', [Updater::class, 'update']);
        Route::post('/addon/update', [Updater::class, 'update']);
        Route::post('/product/update', [Updater::class, 'update']);
        Route::get('/addon/manager', [Updater::class, 'addon_manager']);
        Route::post('/addon/install', [Updater::class, 'update']);
        Route::get('/addon/status/{status}/{id}', [Updater::class, 'addon_status']);
        Route::get('/addon/delete/{id}', [Updater::class, 'addon_delete']);
        Route::get('/addon/form', [Updater::class, 'addon_form']);
    });
});