<?php

namespace Modules\Auth\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Modules\Auth\Events\UserRegistered;
use Modules\Auth\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function showRegistrationForm()
    {
        return view('auth::register');
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function registration(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = User::create($request->except('role'));

            $user->attachRole($request->role);
            $user->generateToken();

            toast('Dear ' . $user->first_name . ', your account has been registered successfully.', 'success');

            UserRegistered::dispatch($user);

            DB::commit();
            Session::flash('user', $user->first_name);

            if (Helper::wantsJsonResponse()) {
                return response()->json([
                    'message' => 'Registration Successful'
                ], 200);
            }

            return redirect()->route('registration.success');
        } catch (QueryException $exception) {
            DB::rollBack();

            if (Helper::wantsJsonResponse()) {
                return response()->json([
                    'message' => 'Try Again'
                ], 409);
            }

            throw new \InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @return Application|Factory|View|RedirectResponse
     */
    public function successView()
    {
        if (Session::has('user')) {
            return view('auth::success');
        }

        return redirect()->route('registration');
    }

    /**
     * @param $token
     * @return RedirectResponse
     */
    public function activate($token)
    {
        $user = User::where('token', $token)->first();

        if ($user) {
            $user->is_active = true;
            $user->activated_by = "self";
            $user->token = null;
            $user->email_verified_at = Carbon::now();

            $user->save();

            toast('Account Activation Successful.', 'success');
            Session::flash('accountActivated', 'Your account has been activated successfully. You can proceed to login now.');

            return redirect()->route('login');
        }

        Session::flash('message', 'Token Invalid');
        return redirect()->route('registration');
    }
}
