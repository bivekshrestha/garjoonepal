<?php

use Illuminate\Support\Facades\Route;
use Modules\Site\Http\Controllers\NewsletterController;
use Modules\Site\Http\Controllers\SiteController;

Route::get('', [SiteController::class, 'index'])->name('home');

Route::get('privacy-policy', [SiteController::class, 'privacyPolicy'])->name('policy.privacy');
Route::get('terms-and-condition', [SiteController::class, 'termsAndCondition'])->name('policy.terms');
Route::get('user-agreement', [SiteController::class, 'userAgreement'])->name('policy.user.agreement');

Route::post('newsletter', [NewsletterController::class, 'store'])->name('newsletter');
