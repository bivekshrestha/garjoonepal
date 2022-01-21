<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\RegisterController;
use Modules\Auth\Http\Controllers\TokenController;
use Modules\Auth\Http\Controllers\UserController;

Route::prefix('auth')
    ->group(function () {
        Route::post('token', [TokenController::class, 'store']);
        Route::delete('token', [TokenController::class, 'destroy']);

        Route::post('register', [RegisterController::class, 'registration']);

        Route::middleware('auth:sanctum')
            ->group(function () {
                Route::post('user', [UserController::class, 'getUser']);
            });
    });
