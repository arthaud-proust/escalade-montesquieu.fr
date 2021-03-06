<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Blog;
use App\Post;
use Validator;
use Response;

class BlogController extends Controller
{
    public function index() {
        $blogs = Blog::all();
        $regulars = Blog::where('is_regular', 1)->get();
        $non_regulars = Blog::where('is_regular', 0)->get();

        return view('blog.index', compact('regulars', 'non_regulars'));
    }

    public function create() {
        return view('blog.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:blog_list,name',
            'slug' => 'required|string|max:255|unique:blog_list,slug',
            'is_regular' => 'required|boolean',
            'description' => 'nullable|string'
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        
        $blog = Blog::create([
            'name' => request('name'),
            'slug' => request('slug'),
            'is_regular' => request('is_regular'),
            'description' => request('description')
        ]);

        return redirect()->route('blogs')->with('status', 'success')->with('content', 'Blog créé');
    }


    public function show(Request $request, $blog_slug) {
        $blog = Blog::where('slug', $blog_slug)->firstOrFail();
        $posts = Post::where('blog', $blog_slug)->take(3)->get();

        return view('blog.show', compact('blog', 'posts'));
    }

    public function edit($blog_slug) {
        $blog = Blog::where('slug', $blog_slug)->firstOrFail();

        return view('blog.edit', compact('blog'));
    }

    public function update(Request $request, $blog_slug) {
        $blog = Blog::where('slug', $blog_slug)->firstOrFail();
        

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:blog_list,name,'.$blog->id,
            'slug' => 'required|string|max:255|unique:blog_list,slug,'.$blog->id,
            'is_regular' => 'required|boolean',
            'description' => 'nullable|string'
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        
        if($blog->slug != request('slug')) {
            $blog->slug = request('slug');
            $posts = Post::where('blog', $blog_slug)->update(['blog' => request('slug')]);
        }

        $blog->name = request('name');
        $blog->is_regular = request('is_regular');
        $blog->description = request('description');
        $blog->save();

        $posts = Post::where('blog', request('slug'))->get();
        // return view('blog.show', compact('blog', 'posts'))->with('status', 'success')->with('content', 'Blog mis à jour');
        return redirect()->route('showBlog', $blog->slug)->with('status', 'success')->with('content', 'Blog mis à jour');
    }

    public function destroy($blog_slug) {
        $blog = Blog::where('slug', $blog_slug)->firstOrFail();

        $blog->delete();
        return redirect()->route('blogs');
    }
}
