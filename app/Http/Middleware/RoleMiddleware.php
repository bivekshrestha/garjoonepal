<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param $role
     * @param $permission
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role, $permission = null)
    {
        if(!$request->user()->hasRole($role)) {

            toast('Sorry, unable to perform this task.','warning');
            return back();

        }

        if($permission !== null && !$request->user()->can($permission)) {
            toast('Sorry, insufficient permission .','warning');
            return back();
        }

        return $next($request);
    }
}
