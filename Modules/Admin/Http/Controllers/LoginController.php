<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function showLoginForm(){
        return view('admin::pages.login');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            if (Auth::user()->hasRole('admin')) {
                toast('You have logged in.', 'success')->autoClose(15000);;
                return redirect()->route('admin.dashboard');
            }

            Auth::logout();
            Session::flush();
        }

        Session::flash('error', 'Invalid Credentials');
        return back();
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
        return redirect()->route('admin.dashboard');
    }
}
