<?php

use Illuminate\Support\Facades\Route;
use Modules\Classified\Http\Controllers\ClassifiedController;

Route::middleware(['auth', 'role:seller'])
    ->group(function () {

        Route::prefix('profile/my-ad')
            ->group(function () {

                Route::get('', [ClassifiedController::class, 'index'])->name('my-ad.index');
                Route::get('in-draft', [ClassifiedController::class, 'draft'])->name('my-ad.draft.index');

                Route::get('add', [ClassifiedController::class, 'addNew'])->name('my-ad.add');
                Route::post('create', [ClassifiedController::class, 'create'])->name('my-ad.create');

                Route::post('store', [ClassifiedController::class, 'store'])->name('my-ad.store');;
                Route::post('draft', [ClassifiedController::class, 'saveAsDraft'])->name('my-ad.draft');;
                Route::get('edit/{slug}', [ClassifiedController::class, 'edit'])->name('my-ad.edit');;
                Route::put('update', [ClassifiedController::class, 'update'])->name('my-ad.update');;

            });
    });

Route::get('{type}/{slug?}', [ClassifiedController::class, 'searchAndFilter'])
    ->where('type', '(services|jobs|motor-vehicles|real-estate|accommodation)')
    ->name('ad.filter');

Route::get('ad/{slug}', [ClassifiedController::class, 'show'])->name('ad.show');

Route::get('filter', [ClassifiedController::class, 'filtering']);
