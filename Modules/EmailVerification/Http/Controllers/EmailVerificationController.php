<?php

namespace Modules\EmailVerification\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\EmailVerification\Entities\Verifiable;
use Modules\EmailVerification\Jobs\SendEmailOTP;

class EmailVerificationController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function sendOTPRequest(Request $request)
    {
        $verifiable = new Verifiable();
        $verifiable->email = $request->email;
        $verifiable->otp = random_int(100000, 999999);
        $verifiable->save();

        SendEmailOTP::dispatch($verifiable);

        return response()->json(['message' => 'An OTP has been sent to your email']);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function verifyOTP(Request $request)
    {
        $verifiable = Verifiable::whereEmail($request->email)->first();

        if ($verifiable->otp == $request->otp) {
            $verifiable->delete();
            return response()->json(['message' => 'Your email has been verified successfully.'], 200);
        }

        return response()->json(['message' => 'Invalid OTP'], 422);
    }
}
