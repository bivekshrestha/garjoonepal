<?php

use Illuminate\Support\Facades\Route;
use Modules\EmailVerification\Http\Controllers\EmailVerificationController;

Route::post('send-otp', [EmailVerificationController::class, 'sendOTPRequest']);
Route::post('verify-otp', [EmailVerificationController::class, 'verifyOTP']);
