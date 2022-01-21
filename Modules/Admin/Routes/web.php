<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AttributeController;
use Modules\Admin\Http\Controllers\CategoryController;
use Modules\Admin\Http\Controllers\CityController;
use Modules\Admin\Http\Controllers\CountryController;
use Modules\Admin\Http\Controllers\DashboardController;
use Modules\Admin\Http\Controllers\LoginController;
use Modules\Admin\Http\Controllers\BrandController;
use Modules\Admin\Http\Controllers\FaqController;

/**
 * All Admin Routes
 */
Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        /**
         * Login Routes
         */
        Route::middleware('guest')
            ->group(function () {
                Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
                Route::post('login', [LoginController::class, 'login'])->name('login');
            });

        /**
         * Logout
         */
        Route::middleware('auth')
            ->post('logout', [LoginController::class, 'logout'])
            ->name('logout');

        /**
         * Authenticated Routes
         * Only Admin Routes
         */
        Route::middleware(['auth', 'role:admin'])
            ->group(function () {
                Route::get('', [DashboardController::class, 'index'])->name('dashboard');

                /**
                 * Category Routes
                 */
                Route::prefix('category')
                    ->name('category.')
                    ->group(function () {
                        Route::get('', [CategoryController::class, 'index'])->name('index');
                        Route::get('create', [CategoryController::class, 'create'])->name('create');
                        Route::post('store', [CategoryController::class, 'store'])->name('store');
                        Route::get('show', [CategoryController::class, 'show'])->name('show');
                        Route::get('edit', [CategoryController::class, 'edit'])->name('edit');
                        Route::put('update', [CategoryController::class, 'update'])->name('update');
                        Route::delete('delete', [CategoryController::class, 'destroy'])->name('delete');
                    });

                /**
                 * Country
                 */
                Route::prefix('country')
                    ->name('country.')
                    ->group(function () {
                        Route::get('', [CountryController::class, 'index'])->name('index');
                        Route::get('create', [CountryController::class, 'create'])->name('create');
                        Route::post('store', [CountryController::class, 'store'])->name('store');
                        Route::get('show', [CountryController::class, 'show'])->name('show');
                        Route::get('edit', [CountryController::class, 'edit'])->name('edit');
                        Route::put('update', [CountryController::class, 'update'])->name('update');
                        Route::delete('delete', [CountryController::class, 'destroy'])->name('delete');
                    });

                /**
                 * City
                 */
                Route::prefix('city')
                    ->name('city.')
                    ->group(function () {
                        Route::get('', [CityController::class, 'index'])->name('index');
                        Route::get('create', [CityController::class, 'create'])->name('create');
                        Route::post('store', [CityController::class, 'store'])->name('store');
                        Route::get('show', [CityController::class, 'show'])->name('show');
                        Route::get('edit', [CityController::class, 'edit'])->name('edit');
                        Route::put('update', [CityController::class, 'update'])->name('update');
                        Route::delete('delete', [CityController::class, 'destroy'])->name('delete');
                    });

//                /**
//                 * Brand
//                 */
//                Route::prefix('brand')
//                    ->name('brand.')
//                    ->group(function () {
//                        Route::get('', [BrandController::class, 'index'])->name('index');
//                        Route::get('create', [BrandController::class, 'create'])->name('create');
//                        Route::post('store', [BrandController::class, 'store'])->name('store');
//                        Route::get('show', [BrandController::class, 'show'])->name('show');
//                        Route::get('edit', [BrandController::class, 'edit'])->name('edit');
//                        Route::put('update', [BrandController::class, 'update'])->name('update');
//                        Route::delete('delete', [BrandController::class, 'destroy'])->name('delete');
//                    });

                /**
                 * FAQs
                 */
                Route::prefix('faq')
                    ->name('faq.')
                    ->group(function () {
                        Route::get('', [FaqController::class, 'index'])->name('index');
                        Route::get('create', [FaqController::class, 'create'])->name('create');
                        Route::post('store', [FaqController::class, 'store'])->name('store');
                        Route::get('show', [FaqController::class, 'show'])->name('show');
                        Route::get('edit', [FaqController::class, 'edit'])->name('edit');
                        Route::put('update', [FaqController::class, 'update'])->name('update');
                        Route::delete('delete', [FaqController::class, 'destroy'])->name('delete');
                    });

                /**
                 * Amenity
                 */
                Route::prefix('attribute')
                    ->name('attribute.')
                    ->group(function () {
                        Route::get('', [AttributeController::class, 'index'])->name('index');
                        Route::get('create', [AttributeController::class, 'create'])->name('create');
                        Route::get('add', [AttributeController::class, 'add'])->name('add');
                        Route::post('store', [AttributeController::class, 'store'])->name('store');
                        Route::get('show', [AttributeController::class, 'show'])->name('show');
                        Route::get('edit', [AttributeController::class, 'edit'])->name('edit');
                        Route::put('update', [AttributeController::class, 'update'])->name('update');
                        Route::delete('delete', [AttributeController::class, 'destroy'])->name('delete');
                    });
            });

    });


