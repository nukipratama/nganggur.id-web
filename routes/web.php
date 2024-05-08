<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminTypeController;
use App\Http\Controllers\AdminSubtypeController;
use App\Http\Controllers\AdminPembayaranController;
use App\Http\Controllers\AdminPencairanController;
use App\Http\Controllers\Auth\RegisterPartnerController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\BidController;

Route::prefix('partner')->name('partner.')->middleware('auth')->group(function () {
    Route::get('/', [PartnerController::class, 'index'])->name('index');
    Route::get('/question', [PartnerController::class, 'question'])->name('question');
    Route::post('upload', [PartnerController::class, 'upload'])->name('upload');
});

Route::get('/', fn () => auth()->check() ? redirect('home') : redirect('projects'));

Auth::routes(['verify' => true]);
Route::get('home', [HomeController::class, 'index'])
    ->middleware(['auth', 'PartnerVerification'])
    ->name('home');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified', 'AdminOnly'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('pelanggan', [AdminController::class, 'pelanggan'])->name('pelanggan');
    Route::get('mitra', [AdminController::class, 'mitra'])->name('mitra');
    Route::get('project', [AdminController::class, 'project'])->name('project');
    Route::get('pencairan', [AdminController::class, 'pencairan'])->name('pencairan');
    Route::get('pembayaran', [AdminController::class, 'pembayaran'])->name('pembayaran');
    Route::get('verifikasi', [AdminController::class, 'verifikasi'])->name('verifikasi');
    Route::post('verifikasi/terima/{partner}', [AdminController::class, 'terima'])->name('verifikasi.terima');
    Route::post('verifikasi/tolak/{partner}', [AdminController::class, 'tolak'])->name('verifikasi.tolak');
    Route::get('type', [AdminController::class, 'type'])->name('type');
    Route::get('type/add', [AdminTypeController::class, 'add'])->name('type.add');
    Route::post('type/post', [AdminTypeController::class, 'post'])->name('type.post');
    Route::get('type/{type}/ubah', [AdminTypeController::class, 'ubah'])->name('type.ubah');
    Route::delete('type/{type}/hapus', [AdminTypeController::class, 'hapus'])->name('type.hapus');
    Route::get('subtype/add', [AdminSubtypeController::class, 'add'])->name('subtype.add');
    Route::post('subtype/post', [AdminSubtypeController::class, 'post'])->name('subtype.post');
    Route::get('subtype/{subtype}/ubah', [AdminSubtypeController::class, 'ubah'])->name('subtype.ubah');
    Route::delete('subtype/{subtype}/hapus', [AdminSubtypeController::class, 'hapus'])->name('subtype.hapus');
    Route::put('pembayaran/{project}/terima', [AdminPembayaranController::class, 'terima'])->name('pembayaran.terima');
    Route::put('pembayaran/{project}/tolak', [AdminPembayaranController::class, 'tolak'])->name('pembayaran.tolak');
    Route::put('pencairan/{project}/terima', [AdminPencairanController::class, 'terima'])->name('pencairan.terima');
    Route::put('pencairan/{project}/tolak', [AdminPencairanController::class, 'tolak'])->name('pencairan.tolak');
});

Route::prefix('register')->middleware('guest')->group(function () {
    Route::get('partner', [RegisterPartnerController::class, 'showRegistrationForm'])
        ->name('register.partner.form');
    Route::post('partner', [RegisterPartnerController::class, 'register'])
        ->name('register.partner.create');
});



Route::middleware(['auth',  'UserAndMitra'])->group(function () {
    Route::prefix('account')->name('account.')->group(function () {
        Route::get('projects', [AccountController::class, 'projects'])->name('projects');
        Route::get('projects/{status_id}', [AccountController::class, 'projects_status'])->name('projects.status');
        Route::get('edit', [AccountController::class, 'edit'])->name('edit');
        Route::put('edit', [AccountController::class, 'put'])->name('edit.put');
        Route::get('password', [AccountController::class, 'password'])->name('password');
        Route::put('password', [AccountController::class, 'passwordPut'])->name('password.put');
        Route::get('{user}', [AccountController::class, 'profile'])->name('profile');
    });
});

Route::middleware(['auth', 'verified', 'UserAndMitra', 'PartnerVerification'])->group(function () {
    // NAVIGATION
    // chat
    Route::prefix('chat')->name('chat.')->group(function () {
        Route::get('/', [ChatController::class, 'index'])->name('index');
        Route::get('unread', [ChatController::class, 'unread'])->name('unread');
        Route::get('count', [ChatController::class, 'count'])->name('count');
        Route::get('{project}', [ChatController::class, 'room'])->name('room');
        Route::post('{project}/send', [ChatController::class, 'send'])->name('send');
        Route::get('{project}/get', [ChatController::class, 'get'])->name('get');
    });
    // notification
    Route::prefix('notification')->name('notification.')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::get('unread', [NotificationController::class, 'unread'])->name('unread');
        Route::get('count', [NotificationController::class, 'count'])->name('count');
        // account
    });

    // project
    Route::prefix('project')->name('project.')->group(function () {
        Route::get('create', [ProjectController::class, 'type'])->name('create');
        Route::get('category/{type}', [ProjectController::class, 'subtype'])->name('subtype');
        Route::get('form/{subtype}', [ProjectController::class, 'form'])->name('form');
        Route::post('post', [ProjectController::class, 'post'])->name('post');
        Route::get('{project}', [ProjectController::class, 'details'])->name('details');
        Route::get('{project}/edit', [ProjectController::class, 'edit'])->name('edit');
        Route::delete('{project}/delete', [ProjectController::class, 'delete'])->name('delete');
        Route::put('{project}/finish', [ProjectController::class, 'finish'])->name('finish');
        Route::post('{project}/review', [ProjectController::class, 'review'])->name('review');
        Route::get('{project}/withdraw', [PaymentController::class, 'withdraw'])->name('withdraw');
        Route::get('{project}/pay', [PaymentController::class, 'pay'])->name('pay');
        Route::post('{project}/pay', [PaymentController::class, 'upload'])->name('pay.upload');
        Route::get('{project}/pay/instruction', [PaymentController::class, 'instruction'])->name('pay.instruction');
        Route::get('{project}/progress', [ProgressController::class, 'form'])->name('progress.form');
        Route::post('{project}/progress', [ProgressController::class, 'post'])->name('progress.post');
        Route::put('{project}/progress/{progress}/verify', [ProgressController::class, 'verify'])->name('progress.verify');
        Route::put('{project}/progress/{progress}/refuse', [ProgressController::class, 'refuse'])->name('progress.refuse');
        Route::get('bid/{bid}', [BidController::class, 'bid'])->name('bid');
        Route::put('bid/{bid}', [BidController::class, 'pick'])->name('bid.pick');
        Route::delete('bid/{bid}/delete', [BidController::class, 'delete'])->name('bid.delete');
        Route::get('{project}/bid/form/', [BidController::class, 'form'])->name('bid.form');
        Route::post('{project}/bid/post', [BidController::class, 'post'])->name('bid.post');
    });
    // search
    Route::prefix('search')->name('search.')->group(function () {
        Route::get('/', [SearchController::class, 'query'])->name('query');
        Route::get('more', [SearchController::class, 'more'])->name('more');
    });
});

Route::prefix('projects')->group(function () {
    Route::get('/', [SearchController::class, 'index'])->name('projects');
    Route::get('{type_title}', [SearchController::class, 'sorted'])->name('projects.sorted');
});

// socialite
Route::get('redirect/{driver}', [LoginController::class, 'redirectToProvider'])->name('login.provider');
Route::get('{driver}/callback', [LoginController::class, 'handleProviderCallback'])->name('login.callback');
