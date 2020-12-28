@extends('layouts.app', ['requirementsJs' => ['app', 'admin']])

@section('title', 'Éditer '.$post->title)
@section('content')
<form class="jumbotron container post-form" id="post-form" action="/post/{{$post->id}}" method="POST">
    @csrf
    @method('PATCH')
    <h1 class="mb-4">Éditer le post</h1>

    <div class="form-row">
        <section class="form-group col-md-4">
            <label for="blog">Poster dans le blog</label>
            <select id="blog" name="blog" class="form-control @error('blog') is-invalid @enderror">
                @foreach($blogs as $blog)
                <option value="{{$blog->slug}}" @if($blog->slug == $post->blog) selected @endif>{{$blog->name}}</option>
                @endforeach
            </select>
            @error('blog')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </section>

        <section class="form-group col-md-4">
            <label for="title">Titre du post</label>
            <input id="title" name="title" class="blog-title form-control @error('title') is-invalid @enderror" value="{{ old('title') ? old('title') : $post->title }}" required></input>
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </section>
        
        
    </div>
    <div class="form-row">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <section class="form-group col-md-4">
            <label for="location">Lieu</label>
            <input id="location" name="location" placeholder="Lycée Montesquieu" class="blog-location form-control @error('location') is-invalid @enderror" value="{{ old('location') ? old('location') : $post->location }}" required></input>
            @error('location')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </section>

        <section class="form-group col-md-4">
            <label for="datetimepicker">Date et heure</label>
            <input type='text' autocomplete="off" class="form-control @error('datetime') is-invalid @enderror" id='datetimepicker' name="datetime" value="{{ old('datetime') ? old('datetime') : $post->datetime }}"/>
            @error('datetime')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </section>

        <section class="form-group col-md-3">
            <label for="maxplaces">Nombre de places</label>
            <div class="input-group">
                <input type='number' autocomplete="off" class="form-control @error('maxplaces') is-invalid @enderror" id='maxplaces' name="maxplaces" value="{{ old('maxplaces') ? old('maxplaces') : $post->maxplaces }}"/>
                <div class="input-group-append" >
                        <label class="input-group-text" style="user-select:none;cursor: pointer;">
                        Places illimitées <input id="maxplaces-toggle" type="checkbox" class="ml-2">
                        </label>
                </div>
            </div>
            @error('maxplaces')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </section>
    </div>

    <section class="form-group">
        <label for="content">Contenu</label>
        <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" rows=3>{{ old('content') ? old('content') : $post->content }}</textarea>
        @error('content')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </section>
</form>

<div class="container d-flex flex-column flex-md-row justify-content-end">
    <a class="btn m-2 btn-link" href="{{ route('showBlog', $post->blog) }}">Annuler</a>
    <button class="btn m-2 btn-success" type="submit" onclick="event.preventDefault(); document.getElementById('post-form').submit();">Enregistrer les modifications</button>
    
    <a class="btn m-2 btn-danger " href="{{ route('destroyPost', ['post'=>$post->id]) }}" onclick="event.preventDefault(); if(confirm('Supprimer ce post?')) document.getElementById('delete-form').submit();">
        Supprimer
    </a>

    <form id="delete-form" action="{{ route('destroyPost', ['post'=>$post->id]) }}" method="POST" style="display: none;">
        @csrf
        @method('delete')
    </form>
</div>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript" defer></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script src="https://unpkg.com/gijgo@1.9.13/js/messages/messages.fr-fr.js" type="text/javascript" defer></script>
@endsection