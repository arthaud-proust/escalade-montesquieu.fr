<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Blog;
use App\Forum;
use App\User;

class header
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
        Session::flash('forum_list', Forum::all());
        Session::flash('blog_list', Blog::all());
        if(Auth::check() && Auth::user()->created_at == Auth::user()->updated_at ) {
            Session::flash('alert-status', 'info');
            Session::flash('alert-content','Votre profil est tout frais, personnalisez-le !');
            Session::flash('alert-link-href', '/profil/edit');
            Session::flash('alert-link-title', 'Modifier le profil');
        }
        
        return $next($request);
    }
}
