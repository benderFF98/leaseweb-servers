<?php

use App\Http\Controllers\ServersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return response()->json('health-check', 200);
});

Route::prefix('servers')->group(function () {
    Route::get('', [ServersController::class, 'index']);
    Route::delete('clear', [ServersController::class, 'clear']);

    Route::post('/import',[ServersController::class,
        'import'])->name('import');
});


