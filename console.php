use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Inspiring;

// API v1 Routes
Route::prefix('v1')->group(function () {
    Route::get('/inspire', function (Request $request) {
        return response()->json([
            'success' => true,
            'data' => [
                'quote' => Inspiring::quote(),
                'author' => 'Unknown' // You might want to extract author from quote
            ]
        ]);
    })->name('api.inspire');
});