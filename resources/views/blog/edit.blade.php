@extends('layouts.app')

@section('title', 'Éditer le blog '.$blog->name)
@section('content')
<form class="jumbotron container blog-form" id="blog-form" action="{{ route('updateBlog', ['blog'=>$blog->slug]) }}" method="POST">
    @csrf
    @method('PATCH')
    <h1 class="mb-4">Éditer {{$blog->name}}</h1>

    <div class="form-row">
        <section class="form-group col-4">
            <label for="name">Nom du blog</label>
            <input id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ? old('name') : $blog->name }}" required></input>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </section>
        
        <section class="form-group col-8">
            <label for="slug">Slug du blog</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="url-addon">https://escalade-montesquieu.fr/blog/</span>
                </div>
                <input id="slug" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') ? old('slug') : $blog->slug }}" aria-describedby="url-addon"></input>
            </div>
            @error('slug')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </section>
    </div>

    <section class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows=3>{{ old('description') ? old('description') : $blog->description }}</textarea>
        @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </section>
    
    <section class="form-check">
        <input type="hidden" class="form-check-input" name="is_regular" value="0">
        <input type="checkbox" class="form-check-input" id="is_regular" name="is_regular" value="1" @if($blog->is_regular) checked @endif>
        <label class="form-check-label" for="is_regular">Posts réguliers</label>
        @error('is_regular')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </section>


</form>
<div class="container">
    <buton class="btn btn-success float-right" type="submit" onclick="event.preventDefault(); document.getElementById('blog-form').submit();">Enregistrer les modifications</button>
    <a class="btn btn-link float-right" href="{{ route('showBlog', ['blog'=>$blog->slug]) }}">Annuler</a>
    
    <a class="btn btn-danger " href="{{ route('destroyBlog', $blog->slug) }}" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
        Supprimer
    </a>

    <form id="delete-form" action="{{ route('destroyBlog', $blog->slug) }}" method="POST" style="display: none;">
        @csrf
        @method('delete')
    </form>
</div>
@endsection