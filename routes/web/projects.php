<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

Route::get('/', [SearchController::class, 'index'])->name('index');
Route::get('{type_title}', [SearchController::class, 'sorted'])->name('sorted');
