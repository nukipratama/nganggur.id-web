<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;

Route::middleware([
    'auth',
    'verified',
    'UserAndMitra',
    'PartnerVerification'
])->group(function () {
    Route::get('/', [NotificationController::class, 'index'])->name('index');
    Route::get('unread', [NotificationController::class, 'unread'])->name('unread');
    Route::get('count', [NotificationController::class, 'count'])->name('count');
});
