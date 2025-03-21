use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware(['auth:sanctum'])->group(function () {
    // Channel subscription endpoint
    Route::post('/subscribe', function (Request $request) {
        $request->validate([
            'channel' => 'required|string',
            'user_id' => 'sometimes|integer'
        ]);

        if ($request->channel === 'user-updates' && $request->user()->id == $request->user_id) {
            return response()->json([
                'success' => true,
                'token' => generateChannelToken($request->channel, $request->user())
            ]);
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    });
});