<?php

namespace App\Http\Middleware;

use Closure;

class AllianceMember
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
        if (\Auth::check()) {
            $user = \Auth::user();
            if ($user->sso->characterPublic->alliance_id === 99002367) {
                return $next($request);
            }

            return redirect('/errors/nonalliancemember');
        }
        return redirect('/eve/auth');
        
    }
}
