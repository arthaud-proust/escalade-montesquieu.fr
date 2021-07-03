<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Photo;
use Validator;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class GalleryController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function index() {
        $galleries = gallery::all()->reverse();
        return view('photos.galleries', compact('galleries'));
    }




    public function show($slug) {
        if (! $gallery = gallery::where('slug', $slug)->first())
        {
            abort(404, 'gallery');
        }
        $photos = photo::where('gallery', $gallery->slug)->get()->reverse();

        return view('photos.gallery.show', compact('gallery', 'photos'));
    }

    



    public function create() {
        return view('photos.gallery.create');
    }




    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:gallery|string|max:255',
            'slug' => 'required|unique:gallery|string|max:255',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp,jfif',
        ]);
        if ($validator->fails()) {
            //on retourne l'erreur
            return back()->withInput()->withErrors($validator);
        }
        
        $imageName = $request->get('name').'.'.request()->img->getClientOriginalExtension();
        request()->img->move(public_path('preview'), $imageName);


        $gallery = gallery::create([
            'name' => $request->get('name'),
            'slug'  => $request->get('slug'),
            'preview'  => '/preview/'.$imageName,
            'text' => $request->get('text'),
        ]);
        return redirect()->route('galleries')->with('status', 'success')->with('content', 'Gallerie ajoutée');
    }




    public function edit($slug) {
        if (! $gallery = gallery::where('slug', $slug)->first())
        {
            abort(404, 'gallery');
        }
        return view('photos.gallery.edit', compact('gallery'));
    }




    public function update(Request $request, $slug) {
        if (! $gallery = gallery::where('slug', $slug)->first())
        {
            abort(404, 'gallery');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,jfif',
        ]);
        if ($validator->fails()) {
            //on retourne l'erreur
            return back()->withInput()->withErrors($validator);
        }

        if($request->img) {
            File::delete(public_path().$gallery->preview);
            $imageName = $request->get('name').'.'.request()->img->getClientOriginalExtension();
            request()->img->move(public_path('preview'), $imageName);

            $gallery->preview = '/preview/'.$imageName;
            $gallery->name = $request->get('name');
            $gallery->text = $request->get('text');
            $gallery->save();
        } else {
            $gallery->name = $request->get('name');
            $gallery->text = $request->get('text');
            $gallery->save();
        }
        

       

        $gallery = $gallery::where('slug', $slug)->first();
        return redirect()->route('showGallery', $gallery->slug)->with('status', 'success')->with('content', 'Modifications enregistrées');
    }





    public function destroy(Request $request, $slug)
    {
        if (! $gallery = gallery::where('slug', $slug)->orWhere('name', $slug)->first())
        {
            abort(404, 'gallery');
        }
        File::delete(public_path().$gallery->preview);
        $gallery->delete();
        return redirect()->route('galleries')->with('status', 'success')->with('content', 'Gallerie supprimée');
    }




}
