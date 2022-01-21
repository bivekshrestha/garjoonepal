<?php

use Illuminate\Support\Facades\Route;
use Modules\Wishlist\Http\Controllers\WishlistController;

Route::middleware(['auth'])
    ->prefix('wishlist')
    ->group(function () {
        Route::get('', [WishlistController::class, 'index'])->name('wishlist');
        Route::post('store', [WishlistController::class, 'store'])->name('wishlist.store');
        Route::post('move', [WishlistController::class, 'move'])->name('wishlist.move');
        Route::delete('delete', [WishlistController::class, 'destroy'])->name('wishlist.delete');
    });
