<?php

use App\Http\Middleware\RedirectIfAuthenticated;
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

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('home');
    } else {
        return redirect('projects');
    }
});

Route::prefix('register')->group(function () {
    Route::get('partner', 'Auth\RegisterPartnerController@showRegistrationForm')->name('register.partner.form');
    Route::post('partner', 'Auth\RegisterPartnerController@register')->name('register.partner.create');
});

Auth::routes(['verify' => true]);
Route::get('home', 'HomeController@index')->middleware('auth')->name('home');
Route::middleware(['auth', 'verified'])->group(function () {
    // NAVIGATION
    // chat
    Route::prefix('chat')->name('chat.')->group(function () {
        Route::get('/', 'ChatController@index')->name('index');
        Route::get('{project_id}', 'ChatController@room')->name('room');
    });
    // notification
    Route::prefix('notification')->name('notification.')->group(function () {
        Route::get('/', 'NotificationController@index')->name('index');
        Route::get('unread', 'NotificationController@unread')->name('unread');
        Route::get('count', 'NotificationController@count')->name('count');
    });
    // account
    Route::prefix('account')->name('account.')->group(function () {
        Route::get('projects', 'AccountController@projects')->name('projects');
        Route::get('projects/{status_id}', 'AccountController@projects_status')->name('projects.status');
        Route::get('edit', 'AccountController@edit')->name('edit');
        Route::put('edit', 'AccountController@put')->name('edit.put');
        Route::get('password', 'AccountController@password')->name('password');
        Route::put('password', 'AccountController@passwordPut')->name('password.put');
        Route::get('{id}', 'AccountController@profile')->name('profile');
    });
    // project
    Route::prefix('project')->name('project.')->group(function () {
        Route::get('create', 'ProjectController@type')->name('create');
        Route::get('category/{type_id}', 'ProjectController@subtype')->name('subtype');
        Route::get('form/{subtype_id}', 'ProjectController@form')->name('form');
        Route::post('post', 'ProjectController@post')->name('post');
        Route::get('{id}', 'ProjectController@details')->name('details');
        Route::get('{id}/edit', 'ProjectController@edit')->name('edit');
        Route::delete('{id}/delete', 'ProjectController@delete')->name('delete');
        Route::put('{id}/finish', 'ProjectController@finish')->name('finish');
        Route::get('{id}/pay', 'PaymentController@pay')->name('pay');
        Route::post('{id}/pay', 'PaymentController@upload')->name('pay.upload');
        Route::get('{id}/pay/instruction', 'PaymentController@instruction')->name('pay.instruction');
        Route::get('{id}/progress', 'ProgressController@form')->name('progress.form');
        Route::post('{id}/progress', 'ProgressController@post')->name('progress.post');
        Route::put('{id}/progress/{progress_id}/verify', 'ProgressController@verify')->name('progress.verify');
        Route::put('{id}/progress/{progress_id}/refuse', 'ProgressController@refuse')->name('progress.refuse');
        Route::get('bid/{id}', 'BidController@bid')->name('bid');
        Route::put('bid/{id}', 'BidController@pick')->name('bid.pick');
        Route::get('bid/{bid_id}/edit', 'BidController@edit')->name('bid.edit');
        Route::delete('bid/{bid_id}/delete', 'BidController@delete')->name('bid.delete');
        Route::get('{project_id}/bid/form/', 'BidController@form')->name('bid.form');
        Route::post('{project_id}/bid/post', 'BidController@post')->name('bid.post');
    });
    // search
    Route::prefix('search')->name('search.')->group(function () {
        Route::get('/', 'SearchController@query')->name('query');
        Route::get('more', 'SearchController@more')->name('more');
    });
});

Route::prefix('projects')->group(function () {
    Route::get('/', 'SearchController@index')->name('projects');
    Route::get('{type_title}', 'SearchController@sorted')->name('projects.sorted');
});

// socialite
Route::get('redirect/{driver}', 'Auth\LoginController@redirectToProvider')->name('login.provider');
Route::get('{driver}/callback', 'Auth\LoginController@handleProviderCallback')->name('login.callback');
