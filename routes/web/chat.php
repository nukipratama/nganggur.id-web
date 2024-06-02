<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

Route::middleware([
    'auth',
    'verified',
    'UserAndMitra',
    'PartnerVerification'
])->group(function () {
    Route::get('/', [ChatController::class, 'index'])->name('index');
    Route::get('unread', [ChatController::class, 'unread'])->name('unread');
    Route::get('count', [ChatController::class, 'count'])->name('count');
    Route::get('{project}', [ChatController::class, 'room'])->name('room');
    Route::post('{project}/send', [ChatController::class, 'send'])->name('send');
    Route::get('{project}/get', [ChatController::class, 'get'])->name('get');
});
