<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\Auth\Events\AccountSwitched;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return UserResource
     */
    public function getUser(Request $request)
    {
        $user = User::select('id', 'first_name', 'last_name', 'email')
            ->whereId(Auth::id())
            ->first();

        $user->roles = $user->availableRoles->pluck('name');
        unset($user->availableRoles);

        return new UserResource($user);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function switchToSellerFromBuyer(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'company_email' => 'required',
            'company_number' => 'required',
        ]);

        $user = Auth::user();
        $user->company_name = $request->company_name;
        $user->company_number = $request->company_number;
        $user->company_email = $request->company_email;
        $user->has_accepted_policy = true;
        $user->has_accepted_terms = true;
        $user->save();

        $user->attachRole('seller');

        AccountSwitched::dispatch($user);

        Session::put('activeRole', 'seller');

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function switchAccount(Request $request)
    {
        if (Auth::user()->hasRole('buyer') && Auth::user()->hasRole('seller')) {
            $activeRole = Session::get('activeRole');
            switch ($activeRole) {
                case 'buyer':
                    Session::put('activeRole', 'seller');
                    break;
                case 'seller':
                    Session::put('activeRole', 'buyer');
                    break;
            }
        }

        return redirect()->back();
    }
}
