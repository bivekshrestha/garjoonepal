<?php

use Illuminate\Support\Facades\Route;
use Modules\SocialAuth\Http\Controllers\SocialAuthController;

Route::get('oauth/{driver}', [SocialAuthController::class, 'redirectToProvider'])->name('social.oauth');
Route::get('oauth/{driver}/callback', [SocialAuthController::class, 'handleProviderCallback'])->name('social.callback');
