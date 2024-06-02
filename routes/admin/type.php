<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminTypeController;

Route::get('add', [AdminTypeController::class, 'add'])->name('add');
Route::post('post', [AdminTypeController::class, 'post'])->name('post');
Route::get('{type}/ubah', [AdminTypeController::class, 'ubah'])->name('ubah');
Route::delete('{type}/hapus', [AdminTypeController::class, 'hapus'])->name('hapus');
