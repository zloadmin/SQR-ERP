<?php

use App\Http\Controllers\Api\TaskController;
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

Route::prefix('/hNsVPep3ZHJ2pEGvqNWG4YhGCdPYWKquAkvuuyWyndBRcSytPvR6FM2kZgczrdnQdJ7ttPerCbB3uuCvyNsXcrk6BtBiMDkQuUB6ro77TPXMNvB4MuXbV56jzzGtwv3n/')->group(function () {
    Route::post('/task/create', [TaskController::class, 'create'])->name('api.create.task');
});

Route::post('test-webhook', function (Request $request) {
   \Illuminate\Support\Facades\Log::info('Test webhook', $request->toArray());
});
