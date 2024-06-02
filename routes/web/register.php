<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterPartnerController;

Route::prefix('partner')->name('partner.')->middleware('guest')->group(function () {
    Route::get('/', [RegisterPartnerController::class, 'showRegistrationForm'])->name('form');
    Route::post('/', [RegisterPartnerController::class, 'register'])->name('create');
});
