<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPembayaranController;

Route::put('{project}/terima', [AdminPembayaranController::class, 'terima'])->name('terima');
Route::put('{project}/tolak', [AdminPembayaranController::class, 'tolak'])->name('tolak');
