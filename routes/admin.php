<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', [AdminController::class, 'index'])->name('index');
Route::get('pelanggan', [AdminController::class, 'pelanggan'])->name('pelanggan');
Route::get('mitra', [AdminController::class, 'mitra'])->name('mitra');
Route::get('project', [AdminController::class, 'project'])->name('project');
Route::get('pencairan', [AdminController::class, 'pencairan'])->name('pencairan');
Route::get('pembayaran', [AdminController::class, 'pembayaran'])->name('pembayaran');
Route::get('type', [AdminController::class, 'type'])->name('type');

Route::get('verifikasi', [AdminController::class, 'verifikasi'])->name('verifikasi');
Route::post('verifikasi/terima/{partner}', [AdminController::class, 'terima'])->name('verifikasi.terima');
Route::post('verifikasi/tolak/{partner}', [AdminController::class, 'tolak'])->name('verifikasi.tolak');

Route::prefix('type')->name('type.')->group(base_path('routes/admin/type.php'));
Route::prefix('subtype')->name('subtype.')->group(base_path('routes/admin/subtype.php'));
Route::prefix('pembayaran')->name('pembayaran.')->group(base_path('routes/admin/pembayaran.php'));
Route::prefix('pencairan')->name('pencairan.')->group(base_path('routes/admin/pencairan.php'));
