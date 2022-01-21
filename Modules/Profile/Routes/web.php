<?php


use Illuminate\Support\Facades\Route;
use Modules\Profile\Http\Controllers\ProfileController;

Route::middleware(['auth'])
    ->prefix('profile')
    ->group(function () {
        Route::get('', [ProfileController::class, 'index'])->name('user.profile');

        Route::put('update', [ProfileController::class, 'update'])->name('user.account.update');

        Route::get('change-password', [ProfileController::class, 'showChangePasswordForm'])->name('user.profile.changePassword');
        Route::post('change-password', [ProfileController::class, 'changePassword'])->name('user.account.changePassword');

        Route::put('pause-account', [ProfileController::class, 'pauseAccount'])->name('user.account.pause');
    });
