@extends('layouts.app')

@section('title', 'Créer un nouveau blog')
@section('content')
<form class="jumbotron container blog-form" action="{{ route('storeBlog') }}" method="POST">
    @csrf
    <h1 class="mb-4">Créer un blog</h1>

    <div class="form-row">
        <section class="form-group col-4">
            <label for="name">Nom du blog</label>
            <input id="name" name="name" class="blog-name form-control @error('name') is-invalid @enderror" value="{{ old('name') ? old('name') : '' }}" required></input>
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

    <section class="form-check">
        <input type="hidden" class="form-check-input" name="is_regular" value="0">
        <input type="checkbox" class="form-check-input" id="is_regular" name="is_regular" value="1">
        <label class="form-check-label" for="is_regular">Posts habituels</label>
        @error('is_regular')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </section>

    <button class="mt-4 btn btn-dark " type="submit">Créer le blog</button>
    <a class="btn btn-dark" href="{{ route('blogs') }}">Annuler</a>
</form>

@endsection