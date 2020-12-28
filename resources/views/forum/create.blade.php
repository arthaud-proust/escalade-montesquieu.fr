@extends('layouts.app', ['requirementsJs' => ['app', 'admin']])


@section('title', 'Créer un nouveau forum')
@section('content')
<form class="jumbotron container forum-form" id="forum-form" action="{{ route('storeForum') }}" method="POST">
    @csrf
    <h1 class="mb-4">Créer un sujet de discussion</h1>

    <div class="form-row">
        <section class="form-group col-md-4">
            <label for="name">Nom du forum</label>
            <input id="name" name="name" class="forum-name form-control @error('name') is-invalid @enderror" value="{{ old('name') ? old('name') : '' }}" required></input>
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
                    <span class="input-group-text" id="url-addon"><span class="d-none d-md-inline">https://escalade-montesquieu.fr</span>/forum/</span>
                </div>
                <input id="slug" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') ? old('slug') : '' }}" aria-describedby="url-addon"></input>
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
        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows=3>{{ old('description') ? old('description') : '' }}</textarea>
        @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </section>

</form>

<div class="container">
    <button class="mt-2 btn btn-dark float-right" type="submit" onclick="event.preventDefault(); document.getElementById('forum-form').submit();">Créer le blog</button>
    <a class="mt-2 btn btn-link float-right" href="{{ route('forums') }}">Annuler</a>
</div>

@endsection