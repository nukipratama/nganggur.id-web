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

// auth
Auth::routes(['verify' => true]);
Route::get('register/partner', 'Auth\RegisterPartnerController@showRegistrationForm')->name('register.partner.form');
Route::post('register/partner', 'Auth\RegisterPartnerController@register')->name('register.partner.create');

//pages
Route::get('projects', function () {
    return view('projects');
})->name('projects');
Route::get('home', 'HomeController@index')->middleware('auth')->name('home');
Route::get('chat', 'ChatController@index')->middleware('auth')->name('chat');
Route::get('notification', 'NotificationController@index')->middleware('auth')->name('notification');
Route::get('account', 'AccountController@index')->middleware('auth')->name('account');
Route::get('project/create', 'HomeController@index')->middleware('auth')->name('project.create');

// socialite
Route::get('redirect/{driver}', 'Auth\LoginController@redirectToProvider')->name('login.provider');
Route::get('{driver}/callback', 'Auth\LoginController@handleProviderCallback')->name('login.callback');
