<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;

Auth::routes(['verify' => true]);
Route::get('/', function () {
    return auth()->check() ? redirect('home.index') : redirect('projects');
});

Route::prefix('partner')->name('partner.')->group(base_path('routes/web/partner.php'));
Route::prefix('home')->name('home.')->group(base_path('routes/web/home.php'));
Route::prefix('register')->name('register.')->group(base_path('routes/web/register.php'));
Route::prefix('account')->name('account.')->group(base_path('routes/web/account.php'));
Route::prefix('chat')->name('chat.')->group(base_path('routes/web/chat.php'));
Route::prefix('notification')->name('notification.')->group(base_path('routes/web/notification.php'));
Route::prefix('search')->name('search.')->group(base_path('routes/web/search.php'));
Route::prefix('project')->name('project.')->group(base_path('routes/web/project.php'));
Route::prefix('projects')->name('projects.')->group(base_path('routes/web/projects.php'));


// socialite
Route::name('login.')->group(function () {
    Route::get('redirect/{driver}', [LoginController::class, 'redirectToProvider'])->name('provider');
    Route::get('{driver}/callback', [LoginController::class, 'handleProviderCallback'])->name('callback');
});
