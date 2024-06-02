<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\BidController;

Route::middleware([
    'auth',
    'verified',
    'UserAndMitra',
    'PartnerVerification'
])->group(function () {
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
