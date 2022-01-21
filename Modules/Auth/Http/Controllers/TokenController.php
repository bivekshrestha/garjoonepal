<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class TokenController extends Controller
{
    /**
     * TokenController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->only('destroy');
    }

    /**
     * @param Request $request
     * @return array
     * @throws AuthenticationException
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw new AuthenticationException();
        }

        return [
            'token' => Auth::user()->createToken($request->deviceId)->plainTextToken
        ];
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function destroy(Request $request)
    {
        return Auth::user()->tokens()->where('name', $request->deviceId)->first()->delete();
    }
}
