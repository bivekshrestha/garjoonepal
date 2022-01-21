<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\ProductController;

Route::middleware(['auth', 'role:seller'])
    ->group(function () {

        Route::prefix('profile/my-product')
            ->group(function () {

                Route::get('', [ProductController::class, 'index'])->name('my-product.index');
                Route::get('in-draft', [ProductController::class, 'draft'])->name('my-product.draft.index');
                Route::get('create', [ProductController::class, 'create'])->name('my-product.create');

                Route::post('store', [ProductController::class, 'store'])->name('my-product.store');;
                Route::post('draft', [ProductController::class, 'saveAsDraft'])->name('my-product.draft');;
                Route::get('edit/{slug}', [ProductController::class, 'edit'])->name('my-product.edit');;
                Route::put('update', [ProductController::class, 'update'])->name('my-product.update');;

            });
    });

Route::get('market/{slug?}', [ProductController::class, 'searchAndFilter'])->name('product.filter');
Route::get('product/{slug}', [ProductController::class, 'show'])->name('product.show');
