<?php

use Illuminate\Support\Facades\Route;
use Modules\Store\Http\Controllers\StoreController;

Route::get('store', [StoreController::class, 'listing'])->name('store');
Route::get('store/{slug}', [StoreController::class, 'view'])->name('store.show');

Route::middleware(['auth', 'role:seller'])
    ->group(function () {

        Route::prefix('profile/my-store')
            ->group(function () {

                Route::get('', [StoreController::class, 'index'])->name('my-store.index');
                Route::get('create', [StoreController::class, 'create'])->name('my-store.create');
                Route::post('store', [StoreController::class, 'store'])->name('my-store.store');;
                Route::get('edit/{slug}', [StoreController::class, 'edit'])->name('my-store.edit');;
                Route::put('update', [StoreController::class, 'update'])->name('my-store.update');;

            });

    });
