@extends('layouts.app', ['requirementsJs' => ['app','admin']])

@section('title', 'Éditer le forum '.$forum->name)
@section('content')
<form class="jumbotron container forum-form" id="forum-form" action="{{ route('updateForum', ['forum'=>$forum->slug]) }}" method="POST">
    @csrf
    @method('PATCH')
    <h1 class="mb-4">Éditer {{$forum->name}}</h1>

    <div class="form-row">
        <section class="form-group col-md-4">
            <label for="name">Nom du forum</label>
            <input id="name" name="name" class="forum-name form-control @error('name') is-invalid @enderror" value="{{ old('name') ? old('name') : $forum->name }}" required></input>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </section>
        
        <section class="form-group col-md-8">
            <label for="slug">Slug du forum</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="url-addon"><span class="d-none d-md-inline">escalade-montesquieu.fr</span>/forum/</span>
                </div>
                <input id="slug" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') ? old('slug') : $forum->slug }}" aria-describedby="url-addon"></input>
                @error('slug')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            
        </section>
    </div>

    <section class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows=3>{{ old('description') ? old('description') : $forum->description }}</textarea>
        @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </section>
</form>

<div class="container d-flex flex-column flex-md-row justify-content-end">
    <button class="btn m-2 btn-success" type="submit" onclick="event.preventDefault(); document.getElementById('forum-form').submit();">Enregistrer les modifications</button>
    <a class="btn m-2 btn-link" href="{{ route('showForum', ['forum'=>$forum->slug]) }}">Annuler</a>
    
    <a class="btn m-2 btn-danger " href="{{ route('destroyForum', $forum->slug) }}" onclick="event.preventDefault(); if(confirm('Supprimer ce forum?')) document.getElementById('delete-form').submit();">
        Supprimer
    </a>

    <form id="delete-form" action="{{ route('destroyForum', $forum->slug) }}" method="POST" style="display: none;">
        @csrf
        @method('delete')
    </form>
</div>

@endsection