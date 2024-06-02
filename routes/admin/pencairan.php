<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPencairanController;

Route::put('{project}/terima', [AdminPencairanController::class, 'terima'])->name('terima');
Route::put('{project}/tolak', [AdminPencairanController::class, 'tolak'])->name('tolak');
