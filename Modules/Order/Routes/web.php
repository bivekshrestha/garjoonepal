<?php

use Illuminate\Support\Facades\Route;
use Modules\Order\Http\Controllers\OrderController;

Route::middleware(['auth'])
    ->prefix('order')
    ->group(function () {
        Route::get('', [OrderController::class, 'index'])->name('order');
        Route::post('store', [OrderController::class, 'store'])->name('order.store');
        Route::delete('delete', [OrderController::class, 'destroy'])->name('order.delete');
    });
