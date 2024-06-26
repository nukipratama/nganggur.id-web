<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AdminOnly
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
        if (Auth::user()->role_id == 0) {
            return $next($request);
        } else {
            return redirect(route('home.index'));
        }
    }
}
