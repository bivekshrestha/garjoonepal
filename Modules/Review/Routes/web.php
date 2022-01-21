<?php

use Illuminate\Support\Facades\Route;
use Modules\Review\Http\Controllers\ReviewController;

Route::middleware('auth')
    ->prefix('review')
    ->name('review.')
    ->group(function () {
        Route::post('store', [ReviewController::class, 'store'])->name('store');
        Route::put('update', [ReviewController::class, 'update'])->name('update');
        Route::delete('delete', [ReviewController::class, 'destroy'])->name('delete');
    });
