<?php

namespace Modules\SocialAuth\Http\Controllers;

use App\Models\User;
use Exception;
use http\Exception\InvalidArgumentException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * SocialAuthController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @var string[]
     */
    protected $providers = [
        'github', 'facebook', 'google', 'twitter'
    ];

    /**
     * @param $driver
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider($driver)
    {
        if (!$this->isProviderAllowed($driver)) {
            return $this->sendFailedResponse("{$driver} is not currently supported");
        }

        try {
            return Socialite::driver($driver)->redirect();
        } catch (Exception $e) {
            // You should show something simple fail message
            return $this->sendFailedResponse($e->getMessage());
        }
    }

    /**
     * @param $driver
     * @return RedirectResponse
     */
    public function handleProviderCallback($driver)
    {
        try {
            $user = Socialite::driver($driver)->user();
        } catch (Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }

        // check for email in returned user
        return empty($user->email)
            ? $this->sendFailedResponse("No email id returned from {$driver} provider.")
            : $this->loginOrCreateAccount($user, $driver);
    }

    /**
     * @return RedirectResponse
     */
    protected function sendSuccessResponse()
    {
        if (Session::has('url-intended')) {
            return redirect(Session::get('url-intended'));
        } else {
            return redirect()->route('home');
        }
    }

    /**
     * @param null $msg
     * @return RedirectResponse
     */
    protected function sendFailedResponse($msg = null)
    {
        return redirect()->route('login')
            ->withErrors(['msg' => $msg ?: 'Unable to login, try with another provider to login.']);
    }

    /**
     * @param $providerUser
     * @param $driver
     * @return RedirectResponse
     */
    protected function loginOrCreateAccount($providerUser, $driver)
    {
        try {
            DB::beginTransaction();
            // check for already has account
            $user = User::where('email', $providerUser->getEmail())->first();

            // if user already found
            if ($user) {
                // update the avatar and provider that might have changed
                if ($user->social) {
                    $user->social()->update([
                        'provider' => $driver,
                        'provider_id' => $providerUser->id,
                        'access_token' => $providerUser->token
                    ]);
                }

            } else {
                // create a new user
                $name = collect(explode(' ', $providerUser->getName()));

                $user = User::create([
                    'first_name' => $name->first(),
                    'last_name' => $name->last(),
                    'email' => $providerUser->getEmail(),
                    'password' => 'zxYu12@&g51',
                    'is_active' => true,
                    'activated_by' => 'self',
                ]);

                $user->attachRole('buyer');
            }

            $user->social()->create([
                'provider' => $driver,
                'provider_id' => $providerUser->getId(),
                'access_token' => $providerUser->token,
            ]);

            DB::commit();

            // login the user
            Auth::login($user, true);
            Session::put('activeRole', 'buyer');

            toast('You have logged in.', 'success');

            return $this->sendSuccessResponse();

        } catch (QueryException $exception) {
            DB::rollBack();
            throw new \InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param $driver
     * @return bool
     */
    private function isProviderAllowed($driver)
    {
        return in_array($driver, $this->providers) && config()->has("services.{$driver}");
    }
}
