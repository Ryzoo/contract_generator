<?php

namespace App\Http\Middleware;

use Closure;

class LoginToApplication
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(\Illuminate\Http\Request $request, Closure $next)
    {
        resolve("AppAuthorization")->setLoggedUserFromRequest($request);
        return $next($request);
    }
}
