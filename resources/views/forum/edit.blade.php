@extends('layouts.app')

@section('title', 'Éditer le forum '.forum->name)
@section('content')
<form class="jumbotron container forum-form" action="{{ route('updateForum', ['forum'=>$forum->slug]) }}" method="POST">
    @csrf
    @method('PATCH')
    <h1 class="mb-4">Éditer {{$forum->name}}</h1>

    <div class="form-row">
        <section class="form-group col-4">
            <label for="name">Nom du forum</label>
            <input id="name" name="name" class="forum-name form-control @error('name') is-invalid @enderror" value="{{ old('name') ? old('name') : $forum->name }}" required></input>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </section>
        
        <section class="form-group col-8">
            <label for="slug">Slug du forum</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="url-addon">https://escalade-montesquieu.fr/forum/</span>
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

    <button class="mt-4 btn btn-success" type="submit">Enregistrer les modifications</button>
    <a class="mt-4 btn btn-dark" href="{{ route('forums') }}">Annuler</a>
</form>

@endsection