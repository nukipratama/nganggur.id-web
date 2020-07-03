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


Route::middleware(['auth', 'verified', 'AdminOnly'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', 'AdminController@index')->name('index');
    Route::get('pelanggan', 'AdminController@pelanggan')->name('pelanggan');
    Route::get('mitra', 'AdminController@mitra')->name('mitra');
    Route::get('project', 'AdminController@project')->name('project');
    Route::get('pencairan', 'AdminController@pencairan')->name('pencairan');
    Route::get('pembayaran', 'AdminController@pembayaran')->name('pembayaran');
    Route::get('type', 'AdminController@type')->name('type');
    Route::get('type/add', 'AdminTypeController@add')->name('type.add');
    Route::post('type/post', 'AdminTypeController@post')->name('type.post');
    Route::get('type/{type}/ubah', 'AdminTypeController@ubah')->name('type.ubah');
    Route::delete('type/{type}/hapus', 'AdminTypeController@hapus')->name('type.hapus');
    Route::get('subtype/add', 'AdminSubtypeController@add')->name('subtype.add');
    Route::post('subtype/post', 'AdminSubtypeController@post')->name('subtype.post');
    Route::get('subtype/{subtype}/ubah', 'AdminSubtypeController@ubah')->name('subtype.ubah');
    Route::delete('subtype/{subtype}/hapus', 'AdminSubtypeController@hapus')->name('subtype.hapus');
    Route::put('pembayaran/{project}/terima', 'AdminPembayaranController@terima')->name('pembayaran.terima');
    Route::put('pembayaran/{project}/tolak', 'AdminPembayaranController@tolak')->name('pembayaran.tolak');
    Route::put('pencairan/{project}/terima', 'AdminPencairanController@terima')->name('pencairan.terima');
    Route::put('pencairan/{project}/tolak', 'AdminPencairanController@tolak')->name('pencairan.tolak');
});

Route::prefix('register')->group(function () {
    Route::get('partner', 'Auth\RegisterPartnerController@showRegistrationForm')->name('register.partner.form');
    Route::post('partner', 'Auth\RegisterPartnerController@register')->name('register.partner.create');
});

Auth::routes(['verify' => true]);
Route::get('home', 'HomeController@index')->middleware('auth')->name('home');
Route::middleware(['auth', 'verified', 'UserAndMitra'])->group(function () {
    // NAVIGATION
    // chat
    Route::prefix('chat')->name('chat.')->group(function () {
        Route::get('/', 'ChatController@index')->name('index');
        Route::get('unread', 'ChatController@unread')->name('unread');
        Route::get('count', 'ChatController@count')->name('count');
        Route::get('{project}', 'ChatController@room')->name('room');
        Route::post('{project}/send', 'ChatController@send')->name('send');
        Route::get('{project}/get', 'ChatController@get')->name('get');
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
        Route::get('{user}', 'AccountController@profile')->name('profile');
    });
    // project
    Route::prefix('project')->name('project.')->group(function () {
        Route::get('create', 'ProjectController@type')->name('create');
        Route::get('category/{type}', 'ProjectController@subtype')->name('subtype');
        Route::get('form/{subtype}', 'ProjectController@form')->name('form');
        Route::post('post', 'ProjectController@post')->name('post');
        Route::get('{project}', 'ProjectController@details')->name('details');
        Route::get('{project}/edit', 'ProjectController@edit')->name('edit');
        Route::delete('{project}/delete', 'ProjectController@delete')->name('delete');
        Route::put('{project}/finish', 'ProjectController@finish')->name('finish');
        Route::post('{project}/review', 'ProjectController@review')->name('review');
        Route::get('{project}/withdraw', 'PaymentController@withdraw')->name('withdraw');
        Route::get('{project}/pay', 'PaymentController@pay')->name('pay');
        Route::post('{project}/pay', 'PaymentController@upload')->name('pay.upload');
        Route::get('{project}/pay/instruction', 'PaymentController@instruction')->name('pay.instruction');
        Route::get('{project}/progress', 'ProgressController@form')->name('progress.form');
        Route::post('{project}/progress', 'ProgressController@post')->name('progress.post');
        Route::put('{project}/progress/{progress}/verify', 'ProgressController@verify')->name('progress.verify');
        Route::put('{project}/progress/{progress}/refuse', 'ProgressController@refuse')->name('progress.refuse');
        Route::get('bid/{bid}', 'BidController@bid')->name('bid');
        Route::put('bid/{bid}', 'BidController@pick')->name('bid.pick');
        Route::delete('bid/{bid}/delete', 'BidController@delete')->name('bid.delete');
        Route::get('{project}/bid/form/', 'BidController@form')->name('bid.form');
        Route::post('{project}/bid/post', 'BidController@post')->name('bid.post');
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
