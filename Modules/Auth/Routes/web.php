<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\LoginController;
use Modules\Auth\Http\Controllers\RegisterController;
use Modules\Auth\Http\Controllers\UserController;
use Modules\Auth\Http\Controllers\UserSecurityController;

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::middleware('throttle:login')->post('login', [LoginController::class, 'login'])->name('login');

    Route::get('sign-up', [RegisterController::class, 'showRegistrationForm'])->name('registration');
    Route::post('sign-up', [RegisterController::class, 'registration'])->name('registration');

    Route::get('sign-up/success', [RegisterController::class, 'successView'])->name('registration.success');
    Route::get('account/activate/{token}', [RegisterController::class, 'activate'])->name('registration.activate');
});

Route::middleware(['auth', '2fa'])->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::post('switch-to-seller-from-buyer', [UserController::class, 'switchToSellerFromBuyer'])->name('user.account.switchToSellerFromBuyer');
    Route::post('switch', [UserController::class, 'switchAccount'])->name('user.account.switch');

    Route::prefix('profile/account')
        ->group(function () {
            Route::get('2fa', [UserSecurityController::class, 'index'])->name('user.2fa');
            Route::post('enable-2fa', [UserSecurityController::class, 'enable2fa'])->name('user.enable2fa');
            Route::post('generate-2fa-secret', [UserSecurityController::class, 'generate2faSecret'])->name('user.generate2faSecret');
            Route::post('disable-2fa', [UserSecurityController::class, 'disable2fa'])->name('user.disable2fa');
        });

});

Route::post('/2faVerify', function () {
    return redirect(URL()->previous());
})->name('2faVerify')->middleware('2fa');
