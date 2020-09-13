<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Blog;
use App\Post;
use Validator;
use Response;

class PostController extends Controller
{
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'blog' => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            $blog = '';
        }

        $blogs = Blog::all();
        $blog_slug = request('blog');
        return view('post.create', compact('blogs', 'blog_slug'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'blog' => 'required|string|max:255',
            'datetime' => 'nullable|date_format:Y-m-d H:i:s',
            'location' => 'nullable|string|max:255',
            'maxplaces' => 'nullable|numeric',
            'content' => 'nullable|string'
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        
        $post = Post::create([
            'title' => request('title'),
            'blog' => request('blog'),
            'datetime' => request('datetime'),
            'location' => request('location'),
            'maxplaces' => request('maxplaces'),
            'content' => request('content')
        ]);

        return redirect('/blog/'.request('blog'))->with('status', 'success')->with('content', 'Post créé');
    }

    public function show($post_id) {
        if(! $post = Post::where('id', $post_id)->first()) {
            return abort('404');
        }

        return response()->json($post);
    }

    public function edit($post_id) {
        if(! $post = Post::where('id', $post_id)->first()) {
            return redirect('404');
        }
        $blogs = Blog::all();
        return view('post.edit', compact('post', 'blogs'));  
    }

    public function update(Request $request, $post_id) {
        if(! $post = Post::where('id', $post_id)->first()) {
            return redirect('404');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'blog' => 'required|string|max:255',
            'datetime' => 'nullable|date_format:Y-m-d H:i:s',
            'location' => 'nullable|string|max:255',
            'maxplaces' => 'nullable|numeric',
            'content' => 'nullable|string'
        ]);
        
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $post->title = request('title');
        $post->blog = request('blog');
        $post->datetime = request('datetime');
        $post->location = request('location');
        $post->maxplaces = request('maxplaces');
        $post->content = request('content');
        $post->save();

        return redirect('/blog/'.request('blog'))->with('status', 'success')->with('content', 'Post mis à jour');
    }

    public function available(Request $request, $post_id) {
        if(! $post = Post::where('id', $post_id)->first()) {
            return response()->json('Not found', 404);
        }

        // décodage des listes json
        $availables = json_decode($post->availables, true);
        $unavailables = json_decode($post->unavailables, true);

        // mise à jour ou définition de l'utilisateur dans la liste "disponible"
        $availables[Auth::user()->name] = [Auth::user()->harness, Auth::user()->shoes];

        // retrait de l'utilisateur de la liste "indisponible"
        foreach (array_keys($unavailables, Auth::user()->name) as $key) {
            unset($unavailables[$key]);
        }

        // encodage des listes json
        $post->availables = json_encode($availables);
        $post->unavailables = json_encode($unavailables);

        $post->save();

        return response()->json($post);
    }

    public function unavailable(Request $request, $post_id) {
        if(! $post = Post::where('id', $post_id)->first()) {
            return response()->json('Not found', 404);
        }

        // décodage des listes json
        $availables = json_decode($post->availables, true);
        $unavailables = json_decode($post->unavailables, true);

        // retrait de l'utilisateur dans la liste "disponible"
        unset($availables[Auth::user()->name]);

        // ajout de l'utilisateur de la liste "indisponible"
        if(!in_array(Auth::user()->name, $unavailables)) {
            array_push($unavailables, Auth::user()->name);
        }

        // encodage des listes json
        $post->availables = json_encode($availables);
        $post->unavailables = json_encode($unavailables);

        $post->save();

        return response()->json($post);
    }

    public function destroy($post_id) {
        if(! $post = Post::where('id', $post_id)->first()) {
            return response()->json('Not found', 404);
        }
        $blog = $post->blog;
        $post->delete();

        return redirect('/blog/'.$blog)->with('status', 'success')->with('content', 'Post supprimé');
    }
}
