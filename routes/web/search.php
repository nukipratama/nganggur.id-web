<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

Route::middleware([
    'auth',
    'verified',
    'UserAndMitra',
    'PartnerVerification'
])->group(function () {
    Route::get('/', [SearchController::class, 'query'])->name('query');
    Route::get('more', [SearchController::class, 'more'])->name('more');
});
