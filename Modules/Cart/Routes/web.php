<?php


use Illuminate\Support\Facades\Route;
use Modules\Cart\Http\Controllers\CartController;

Route::middleware(['auth'])
    ->prefix('cart')
    ->group(function () {
        Route::get('', [CartController::class, 'index'])->name('cart');
        Route::post('store', [CartController::class, 'store'])->name('cart.store');
        Route::delete('delete', [CartController::class, 'destroy'])->name('cart.delete');
    });
