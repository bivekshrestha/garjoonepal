<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\Auth\Entities\LoginLog;
use Modules\Auth\Http\Requests\LoginRequest;
use Stevebauman\Location\Facades\Location;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (!session()->has('url-intended')) {
            session(['url-intended' => url()->previous()]);
        }

        return view('auth::login');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    public function login(LoginRequest $request)
    {

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'is_active' => 1,
            'is_paused' => 0
        ];

        if (Auth::attempt($credentials)) {

            if (Auth::user()->hasRole('buyer', 'seller')) {

                if (!Auth::user()->log) {
                    $this->logger('110.34.22.13');
                }

                if (Auth::user()->hasRole('buyer') && Auth::user()->hasRole('seller')) {
                    Session::put('activeRole', 'buyer');
                } else {
                    Session::put('activeRole', Auth::user()->roles()->first()->slug);
                }

                $request->session()->regenerate();
                toast('You have logged in.', 'success');

                if (Session::has('url-intended')) {
                    return redirect(Session::get('url-intended'));
                } else {
                    return redirect()->route('home');
                }

            }

        }


        Auth::logout();
        Session::flush();

        Session::flash('error', 'Invalid email address or password.');;
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();

        toast('You have logged out.', 'success');
        return redirect()->route('home');
    }

    /**
     * @param $ip
     */
    private function logger($ip)
    {
        $data = Location::get('110.34.22.13');

        LoginLog::create([
            'user_id' => Auth::id(),
            'country' => $data->countryName,
            'city' => $data->cityName,
            'latitude' => $data->latitude,
            'longitude' => $data->longitude,
            'ip_address' => $ip,
        ]);

    }
}
