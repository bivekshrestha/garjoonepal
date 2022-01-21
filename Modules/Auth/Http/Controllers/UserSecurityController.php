<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Entities\UserSecurity;

class UserSecurityController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $google2fa_url = "";
        if ($user->security()->exists()) {
            $google2fa = app('pragmarx.google2fa');
            $google2fa_url = $google2fa->getQRCodeInline(
                'Garjoo Nepal',
                $user->email,
                $user->security->google2fa_secret
            );
        }
        $data = array(
            'user' => $user,
            'google2fa_url' => $google2fa_url
        );

        return view('auth::2fa.index')->with('data', $data);
    }

    public function generate2faSecret(Request $request)
    {
        $user = Auth::user();
        // Initialise the 2FA class
        $google2fa = app('pragmarx.google2fa');

        // Add the secret key to the registration data
        UserSecurity::create([
            'user_id' => $user->id,
            'google2fa_enable' => 0,
            'google2fa_secret' => $google2fa->generateSecretKey(),
        ]);

        return redirect()->route('user.2fa')->with('success', "Secret Key is generated, Please verify Code to Enable 2FA");
    }

    public function enable2fa(Request $request)
    {
        $user = Auth::user();
        $google2fa = app('pragmarx.google2fa');
        $secret = $request->input('verify-code');
        $valid = $google2fa->verifyKey($user->security->google2fa_secret, $secret);
        if ($valid) {
            $user->security->google2fa_enable = 1;
            $user->security->save();
            return redirect()->route('user.2fa')->with('success', "2FA is Enabled Successfully.");
        } else {
            return redirect()->route('user.2fa')->with('error', "Invalid Verification Code, Please try again.");
        }
    }

    public function disable2fa(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your  password does not matches with your account password. Please try again.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
        ]);

        $user = Auth::user();
        $user->security->google2fa_enable = 0;
        $user->security->save();

        return redirect()->route('user.2fa')->with('success', "2FA is now Disabled.");
    }

}
