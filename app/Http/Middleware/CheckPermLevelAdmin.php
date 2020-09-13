<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\User;
use JWTAuth;
use Response;

use Closure;

class CheckPermLevelAdmin
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
        if (Auth::check()) {
            if(Auth::user()->level >= 3) {
                return $next($request);
            } else {
                return abort(403);
            }
        } else {
            return redirect('/login');
        }
        
    }
}
