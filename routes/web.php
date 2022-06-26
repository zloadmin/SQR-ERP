<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserRoleController;

use App\Http\Livewire\Setting\SettingList;
use App\Http\Livewire\User\CreateUser;
use App\Http\Livewire\User\EditUser;
use App\Http\Livewire\User\UserList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::middleware('auth')->get('/', function () {
//    return view('welcome');
//})->name('index');

Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'showLoginForm')->name('login');
    Route::post('login', 'login');
    Route::post('logout', 'logout')->name('logout');
});
// Auth
Route::middleware('auth')->group(function () {
    Route::controller(DashboardController::class)->name('dashboard')->group(function () {
        Route::get('/', 'index');
    });
    // User can change settings
    Route::middleware('role:settings')->controller(SettingsController::class)->prefix('settings')->group(function () {
        Route::get('/', SettingList::class)->name('settings');
        Route::controller(UserRoleController::class)->prefix('user-role')->group(function () {

            Route::get('/', 'index')->name('settings.user-role');
//            Route::get('/', UserRoleList::class)->name('settings.user-role');

            Route::get('/create', 'create')->name('settings.user-role.create');
//            Route::get('/create', UserRoleCreate::class)->name('settings.user-role.create');
            Route::post('/create', 'store');
            Route::get('/edit/{user_role}', 'edit')->name('settings.user-role.edit');
            Route::delete('/edit/{user_role}/delete', 'delete')->name('settings.user-role.delete');
        });
        Route::prefix('user')->group(function () {
            Route::get('/', UserList::class)->name('settings.user');
            Route::get('/create', CreateUser::class)->name('settings.user.create');
            Route::get('/edit/{user}', EditUser::class)->name('settings.user.edit');
        });
    });
});


//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
