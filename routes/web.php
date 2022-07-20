<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserRoleController;

use App\Http\Livewire\Email\EmailList;
use App\Http\Livewire\EmailAlert\CreateEmailAlert;
use App\Http\Livewire\EmailAlert\EditEmailAlert;
use App\Http\Livewire\EmailAlert\EmailAlertList;
use App\Http\Livewire\KanbanDashboard;
use App\Http\Livewire\Setting\SettingList;
use App\Http\Livewire\SLA\CreateSLA;
use App\Http\Livewire\SLA\EditSLA;
use App\Http\Livewire\SLA\SLAList;
use App\Http\Livewire\Tag\CreateTag;
use App\Http\Livewire\Tag\EditTag;
use App\Http\Livewire\Tag\TagList;
use App\Http\Livewire\Task\CreateTask;
use App\Http\Livewire\Task\EditForm\Actions;
use App\Http\Livewire\Task\EditForm\ActionsSecret;
use App\Http\Livewire\Task\EditForm\EditOrderDetails;
use App\Http\Livewire\Task\EditTask;
use App\Http\Livewire\User\CreateUser;
use App\Http\Livewire\User\EditUser;
use App\Http\Livewire\User\UserList;
use App\Http\Livewire\WebHook\CreateWebHook;
use App\Http\Livewire\WebHook\EditWebHook;
use App\Http\Livewire\WebHook\WebHookList;
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


Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'showLoginForm')->name('login');
    Route::post('login', 'login');
    Route::post('logout', 'logout')->name('logout');
});
Route::prefix('task-secret')->group(function () {
    Route::get('/edit/{uuid}/actions', ActionsSecret::class)->name('task-secret.task.edit.action');
});

// Auth
Route::middleware('auth')->group(function () {
    Route::get('/', KanbanDashboard::class)->name('dashboard');
    // TODO: Delete start
    Route::prefix('task')->group(function () {
        Route::get('/create', CreateTask::class)->name('task.create');
        Route::get('/edit/{task}', EditTask::class)->name('task.edit');
        Route::get('/edit/{task_uuid}/actions', EditOrderDetails::class)->name('task.edit.edit-order-detail');
    });
    // TODO: Delete end

    Route::middleware('role:settings')->group(function () {
        Route::get('emails', EmailList::class)->name('emails');
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
        Route::prefix('sla')->group(function () {
            Route::get('/', SLAList::class)->name('settings.sla');
//            Route::get('/create', CreateSLA::class)->name('settings.sla.create');
            Route::get('/edit/{sla}', EditSLA::class)->name('settings.sla.edit');
        });
        Route::prefix('tag')->group(function () {
            Route::get('/', TagList::class)->name('settings.tag');
            Route::get('/create', CreateTag::class)->name('settings.tag.create');
            Route::get('/edit/{tag}', EditTag::class)->name('settings.tag.edit');
        });
        Route::prefix('email_alert')->group(function () {
            Route::get('/', EmailAlertList::class)->name('settings.emailalert');
            Route::get('/create', CreateEmailAlert::class)->name('settings.emailalert.create');
            Route::get('/edit/{emailAlert}', EditEmailAlert::class)->name('settings.emailalert.edit');
        });
        Route::prefix('web_hooks')->group(function () {
            Route::get('/', WebHookList::class)->name('settings.webhook');
            Route::get('/create', CreateWebHook::class)->name('settings.webhook.create');
            Route::get('/edit/{webHook}', EditWebHook::class)->name('settings.webhook.edit');
        });
    });
});

Route::get('/test-socket', function (){
    return view('test.socket');
});
Route::post('/test-socket', function (){
    event(new \App\Events\TestSocket());
});
//Route::post('/test-webhook', function (){
//    event(new \App\Events\TestSocket());
//});

//event(new \App\Events\TestSocket());
//exit;
//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
