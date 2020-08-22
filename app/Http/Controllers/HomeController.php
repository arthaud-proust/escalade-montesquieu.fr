<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Blog;
use App\Post;
use App\Forum;
use Validator;
use Response;

class HomeController extends Controller
{
    public function index() {
        $current_datetime = strtotime(Carbon::now()->toDateString());

        $comingPosts = Post::orderBy('datetime')->get()->filter(function ($post) use ($current_datetime) {
            $diff = (strtotime(explode(" ", $post->datetime)[0])-$current_datetime)/86400;
            return (0 <= $diff);
        })->values()->take(4);
        $forums = Forum::all();
        // return response()->json([$comingPosts]);
        return view('home', compact('comingPosts', 'forums'));
    }
}
