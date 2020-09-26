@extends('layouts.app', ['requirementsJs' => ['app', 'admin']])

@section('title', "Ajouter une photo à ".$request->get('gallery'))

@section('content')

<div class="container">
    <form class="photo-form needs-validation mt-5" novalidate action="{{ route('storePhoto') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="img">Photo</label>
                <input type="file" class="form-control-file {{$errors->first('img') ? 'is-invalid':''}}" name="img" id="img" required>
                <div class="invalid-feedback">
                    {{$errors->first('img')}}
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-3 mb-3">
                <label for="gallery">Gallerie</label>
                <select class="form-control" id="gallery" name="gallery">
                    @foreach($galleries as $gallery)
                        <option value="{{ $gallery->slug }}" {{ $gallery->name == $request->get('gallery') ? "selected" : "" }}>{{ $gallery->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label for="background">Couleur de fond</label>
                <select class="form-control" id="background" name="background">
                    <option value="#010203">Noir profond</option>
                    <option value="#0e0e0e">Gris foncé</option>
                    <option value="#282828">Gris neutre</option>
                    <option value="#787878">Gris clair</option>
                    <option value="#D3D3D3">Gris très clair</option>
                    <option value="#F5F5F5">Blanc</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="name">Nom</label>
                <input type="text" class="form-control {{$errors->first('name') ? 'is-invalid':''}}" id="name" name="name" placeholder="ex: Contest Juin" value="{{ old('name') }}">
                <div class="invalid-feedback">
                    {{$errors->first('name')}}
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="slug">Slug (lien de la photo)</label>
                <input type="text" class="form-control {{$errors->first('slug') ? 'is-invalid':''}}" id="slug" name="slug" placeholder="escalade-montesquieu.fr/photos/galerie1/contest_juin" value="{{ old('slug') }}" required>
                <div class="invalid-feedback">
                    {{$errors->first('slug')}}
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="date">Date (optionnel)</label>
                <input type="text" class="form-control" id="date" name="date" placeholder="ex: 13 Juin" value="{{ old('date') }}">
            </div>
        </div>
        <div class="form-group">
            
            <label for="text">Texte (optionnel)</label>
            <textarea class="form-control" id="text" name="text" rows="3">{{ old('text') }}</textarea>
        </div>
        <button class="btn btn-dark" type="submit">Ajouter la photo</button>
        <a class="btn btn-link-dark" href="{{ route('galleries') }}">Annuler</a>
    </form>
</div>


@endsection
