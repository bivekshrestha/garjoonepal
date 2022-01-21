<?php

namespace Modules\Profile\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Modules\Profile\Events\AccountPaused;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data['user'] = User::select('first_name', 'last_name', 'company_name', 'company_number', 'company_email')
            ->whereId(Auth::id())
            ->first();

        return view('profile::index', $data);
    }

    /**
     * @return Application|Factory|View
     */
    public function showChangePasswordForm()
    {
        return view('profile::password');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $user->update($request->all());

        return redirect()->route('user.profile');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->getAuthPassword())) {
                        $fail('The old password is invalid.');
                    }
                }
            ],
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = Auth::user();

        $user->update(['password' => $request->password]);

        return redirect()->route('user.profile');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function pauseAccount(Request $request)
    {
        $user = Auth::user();

        $user->is_active = false;
        $user->is_paused = true;
        $user->save();

        AccountPaused::dispatch($user);

        Auth::logout();
        Session::flush();

        toast('Your account has been paused.', 'success');

        return redirect()->route('home');
    }
}
