@extends('layouts.app')

@section('title', 'Créer un nouveau post')
@section('content')
<form class="jumbotron container blog-form" action="/post" method="POST">
    @csrf
    <h1 class="mb-4">Rédiger un post</h1>

    <div class="form-row">
        <section class="form-group col-4">
            <label for="title">Titre du post</label>
            <input id="title" name="title" class="blog-title form-control @error('title') is-invalid @enderror" value="{{ old('title') ? old('title') : '' }}" required></input>
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </section>
        
        <section class="form-group col-4">
            <label for="blog">Blog du post</label>
            <select id="blog" name="blog" class="form-control @error('blog') is-invalid @enderror">
                @foreach($blogs as $blog)
                <option value="{{$blog->slug}}" @if($blog->slug == $blog_slug) selected @endif>{{$blog->name}}</option>
                @endforeach
            </select>
            @error('blog')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </section>
    </div>

    <div class="form-row">
        <section class="form-group col-4">
            <label for="location">Lieu</label>
            <input id="location" name="location" placeholder="Lycée Montesquieu" class="blog-location form-control @error('location') is-invalid @enderror" value="{{ old('location') ? old('location') : '' }}"></input>
            @error('location')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </section>

        <section class="form-group col-4">
            <label for="datetimepicker">Date et heure</label>
            <input type='text' autocomplete="off" class="form-control @error('datetime') is-invalid @enderror" id='datetimepicker' name="datetime" value="{{ old('datetime') ? old('datetime') : '' }}"/>
            @error('datetime')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </section>
    </div>

    <section class="form-group">
        <label for="content">Contenu</label>
        <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" rows=3>{{ old('content') ? old('content') : '' }}</textarea>
        @error('content')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </section>

    <button class="mt-4 btn btn-dark " type="submit">Créer le post</button>
</form>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript" defer></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script src="https://unpkg.com/gijgo@1.9.13/js/messages/messages.fr-fr.js" type="text/javascript" defer></script>
<script src="/js/blog.js" defer></script>
@endsection