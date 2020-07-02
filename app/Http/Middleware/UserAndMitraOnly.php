<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Route;

class UserAndMitraOnly
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
        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2) {
            return $next($request);
        } else {
            return redirect(route('home'));
        }
    }
}
