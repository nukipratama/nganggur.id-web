<?php

namespace App\Http\Middleware;

use App\Partner;
use App\User;
use Closure;

class PartnerVerification
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
        if (auth()->user()->role_id == 2) {
            $status = Partner::where('user_id', auth()->id())->first();
            if (!$status->verified_at) {
                return redirect(route('partner.index'));
            }
        }
        return $next($request);
    }
}
