<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

Route::middleware(['auth', 'UserAndMitra'])->group(function () {
    Route::get('projects', [AccountController::class, 'projects'])->name('projects');
    Route::get('projects/{status_id}', [AccountController::class, 'projects_status'])->name('projects.status');
    Route::get('edit', [AccountController::class, 'edit'])->name('edit');
    Route::put('edit', [AccountController::class, 'put'])->name('edit.put');
    Route::get('password', [AccountController::class, 'password'])->name('password');
    Route::put('password', [AccountController::class, 'passwordPut'])->name('password.put');
    Route::get('{user}', [AccountController::class, 'profile'])->name('profile');
});
