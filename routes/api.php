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

Route::prefix('/vH6iXDwYyRg6BFiJ^ZvCk@tzdbbeS$D!2%%VdrgF3QtpQCR35HnqaWe^4pxFXniWQETbpmF5mWsUU$zMtbYnFnp2DA$c3yEw4TEKb7QxBvxoYcGmzk2L%5Ajm9wESf%Y/')->group(function () {
    Route::post('/task/create', [TaskController::class, 'create'])->name('api.create.task');
});
