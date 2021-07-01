<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;

class ApiAuthMiddleware
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
        // JWTAuth::parseToken()->authenticate();
        $payload = auth()->guard('api')->payload();
       return $next($request);
    }
}
