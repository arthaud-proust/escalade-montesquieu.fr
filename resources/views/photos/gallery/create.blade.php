@extends('layouts.app', ['requirementsJs' => ['app', 'admin']])

@section('title', "Nouvelle galerie")




@section('content')

<div class="container">
    @include('components.alert')
    <form class="gallery-form needs-validation mt-5" novalidate action="{{ route('storeGallery') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="img">Vignette</label>
                <input type="file" class="form-control-file @error('img') is-invalid @enderror" name="img" id="img" required>
                @error('img')
                    <span class="Field-invalidFeedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="name">Nom</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="ex: Sorties falaise" value="{{ old('name') }}" required>
                @error('name')
                    <span class="Field-invalidFeedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="slug">Slug (lien de la galerie)</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" placeholder="ex: escalade-montesquieu.fr/photos/sorties-falaise" value="{{ old('slug') }}" required>
                @error('slug')
                    <span class="Field-invalidFeedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="text">Texte (optionnel)</label>
            <textarea class="form-control" id="text" name="text" rows="3">{{ old('text') }}</textarea>
        </div>
        <button class="btn btn-primary" type="submit">Créer</button>
        <a class="btn btn-link-dark" href="{{ route('galleries') }}">Annuler</a>
    </form>
</div>

@endsection
