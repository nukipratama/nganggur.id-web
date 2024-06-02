<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminSubtypeController;

Route::get('add', [AdminSubtypeController::class, 'add'])->name('add');
Route::post('post', [AdminSubtypeController::class, 'post'])->name('post');
Route::get('{subtype}/ubah', [AdminSubtypeController::class, 'ubah'])->name('ubah');
Route::delete('{subtype}/hapus', [AdminSubtypeController::class, 'hapus'])->name('hapus');
