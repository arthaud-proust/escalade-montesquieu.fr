@extends('layouts.app', ['requirementsJs' => ['app', 'admin']])

@section('title', "Modifier une photo")


@section('content')

<div class="container">
    <form class="photo-form needs-validation mt-5" novalidate action="{{ route('updatePhoto', $photo->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PATCH")
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="{{ $photo->src }}" alt="Card image cap">
        </div>
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
            <div class="col-md-4 mb-3">
                <input type="checkbox" class="ml-0 form-check-input" id="exposed" name="exposed" @if(old('exposed')?old('exposed'):$photo->exposed==true)checked @endif>
                <label for="exposed" class="ml-4 form-check-label" style="user-select:none">Montrer la photo sur la page d'accueil</label>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-3 mb-3">
                <label for="background">Couleur de fond</label>
                <select class="form-control" id="background" name="background">
                    @if($photo->background)
                    <option value="{{$photo->background}}" selected>Ne pas changer</option>
                    @endif
                    <option value="#010203">Noir profond</option>
                    <option value="#0e0e0e">Gris foncé</option>
                    <option value="#282828">Gris neutre</option>
                    <option value="#787878">Gris clair</option>
                    <option value="#D3D3D3">Gris très clair</option>
                    <option value="#F5F5F5">Blanc</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="name">Nom (optionnel)</label>
                <input type="text" class="form-control {{$errors->first('name') ? 'is-invalid':''}}" id="name" name="name" placeholder="ex: Contest Juin" value="{{ $photo->name }}">
                <div class="invalid-feedback">
                    {{$errors->first('name')}}
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="date">Date (optionnel)</label>
                <input type="text" class="form-control" id="date" name="date" placeholder="ex: 13 Juin" value="{{ $photo->date }}">
            </div>
        </div>
        <div class="form-group">
            
            <label for="text">Texte (optionnel)</label>
            <textarea class="form-control" id="text" name="text" rows="3" placeholder="Par exemple une courte description présentant la photo, rajoutant du contexte">{{ $photo->text }}</textarea>
        </div>
        <button class="btn btn-success" type="submit">Modifier la photo</button>
        <a class="btn btn-link-dark" href="{{ route('showGallery', $photo->gallery) }}">Annuler</a>
    </form>
    <form action="{{ route('destroyPhoto', $photo->slug) }}" method="POST">
        @csrf
        @method('delete')
        <button class="btn btn-outline-danger float-right" type="submit">Supprimer la photo</button>
    </form>
</div>


@endsection
