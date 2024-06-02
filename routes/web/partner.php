<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartnerController;

Route::middleware('auth')->group(function () {
    Route::get('/', [PartnerController::class, 'index'])->name('index');
    Route::get('/question', [PartnerController::class, 'question'])->name('question');
    Route::post('upload', [PartnerController::class, 'upload'])->name('upload');
});
