<?php

namespace App\Http\Middleware;

use Closure;

class FrontEndAuthMiddleware
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
        if (auth()->check() && auth()->user()->isVerified() && (auth()->user()->hasRole('normal') ||auth()->user()->hasRole('wseller'))) {
            return $next($request);
        }

        if ( ! auth()->check()) {
            return redirect()->route('customer_login')->with('failure_message', 'You must be logged in to perform this action.');
        }

        return redirect()->back()->with('failure_message', 'You must be a valid user to perform this action.');
       }
}
