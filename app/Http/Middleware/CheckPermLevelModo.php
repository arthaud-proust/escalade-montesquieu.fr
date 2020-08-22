<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\User;
use JWTAuth;
use Response;

use Closure;

class CheckPermLevelModo
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
            if(Auth::user()->level >= 2) {
                return $next($request);
            } else {
                return response()->json('Not authorized', 403);
            }
        } else {
            return redirect('/login');
        }
    }
}
