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
    //navigation
    Route::get('chat', 'ChatController@index')->name('chat');
    Route::get('notification', 'NotificationController@index')->name('notification');
    //account
    Route::prefix('account')->name('account')->group(function () {
        Route::get('/', 'AccountController@index');
        Route::get('projects', 'AccountController@projects')->name('.projects');
        Route::get('edit', 'AccountController@edit')->name('.edit');
        Route::get('password', 'AccountController@password')->name('.password');
    });
    //project
    Route::prefix('project')->name('project.')->group(function () {
        Route::get('create', 'ProjectController@type')->name('create');
        Route::get('category/{type_id}', 'ProjectController@subtype')->name('subtype');
        Route::get('form/{subtype_id}', 'ProjectController@form')->name('form');
        Route::post('post', 'ProjectController@post')->name('post');
        Route::get('edit/{id}', 'ProjectController@edit')->name('edit');
        Route::put('update', 'ProjectController@update')->name('update');
        Route::delete('delete', 'ProjectController@delete')->name('delete');
        Route::get('bid/edit/{bid_id}', 'ProjectController@bidEdit')->name('bid.edit');
        Route::get('bid/form/{project_id}', 'ProjectController@bidForm')->name('bid.form');
        Route::post('bid/post/{project_id}', 'ProjectController@bidPost')->name('bid.post');
        Route::get('bid/{id}', 'ProjectController@bid')->name('bid');
        Route::put('bid/{id}', 'ProjectController@bidPick')->name('bid.pick');
        Route::get('{id}', 'ProjectController@details')->name('details');
    });
});
//search
Route::prefix('projects')->group(function () {
    Route::get('/', 'SearchController@index')->name('projects');
    Route::get('{type_title}', 'SearchController@sorted')->name('projects.sorted');
});

// socialite
Route::get('redirect/{driver}', 'Auth\LoginController@redirectToProvider')->name('login.provider');
Route::get('{driver}/callback', 'Auth\LoginController@handleProviderCallback')->name('login.callback');
