<?php

namespace App\Http\Middleware;

use Closure;
use \Illuminate\Support\Facades\Auth;

class AuthrorizedUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('vendor')) {
            return $next($request);
        }


        /*user is redirect to frontend home becase use must be with role normal*/

        return redirect()->route('home')->with('failure_message', 'You are not authorized user!.');
    }
}
