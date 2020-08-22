<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\Blog;
use App\Forum;

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
        return $next($request);
    }
}
