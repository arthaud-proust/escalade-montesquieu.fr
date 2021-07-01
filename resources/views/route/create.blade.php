@extends('layouts.app', ['requirementsJs' => ['app', 'admin']])


@php

$colors = [
    'yellow' => 'Jaune',
    'red'=>'Rouge',
    'blue'=>'Bleu',
    'black'=>'Noir',
    'orange'=>'Orange',
    'green'=>'Vert',
    'purple'=>'Violet',
    'white'=>'Blanc',
    'grey'=>'Gris'
];

$sectors = [
    'route' => 15,
    'traverse' => 3
];

@endphp

@section('title', 'Modifier la salle en 3D')
@section('content')
<form class="jumbotron container blog-form" id="blog-form" action="{{ route('route.store') }}" method="POST">
    @csrf
    <h1 class="mb-4">Ajouter une voie/un bloc</h1>

    <div class="form-row">
        <section class="Field select @error('type') is-invalid @enderror">
            <label class="Field-label" for="type">Type</label>
            <select class="Field-input" id="type" name="type">
                <option value="route" @if(old('type')=='route') selected @endif>Voie</option>
                <option value="bloc" @if(old('type')=='bloc') selected @endif>Bloc</option>
            </select>
            @error('type')
                <span class="Field-invalidFeedback" role="alert">{{ $message }}</span>
            @enderror
        </section>


        <section class="Field text @error('diff') is-invalid @enderror">
            <label class="Field-label" for="diff">Difficulté</label>
            <input class="Field-input" id="diff" name="diff" type="text" placeholder="9c+" value="{{ old('diff') }}">
            <small class="Field-info">Pour une voie: 4a à 9c+, pour un bloc: facile, moyen ou difficile</small>

            @error('diff')
                <span class="Field-invalidFeedback" role="alert">{{ $message }}</span>
            @enderror
        </section>


        <section class="Field select @error('color') is-invalid @enderror">
            <label class="Field-label" for="color">Couleur</label>
            <select class="Field-input" id="color" name="color">
                @foreach($colors as $value=>$color)
                    <option value="{{ $value }}" @if(old('color')==$value) selected @endif>{{ $color }}</option>
                @endforeach
            </select>
            @error('color')
                <span class="Field-invalidFeedback" role="alert">{{ $message }}</span>
            @enderror
        </section>


        
        <section class="Field text @error('sectors') is-invalid @enderror">
            <label class="Field-label">Voie</label>
            <div>
                @for($iRoute=1; $iRoute<=$sectors['route'];$iRoute++)
                <div class="custom-control custom-checkbox custom-control-inline epureCheckbox">
                    <input type="checkbox" class="custom-control-input" id="sectors[r{{ $iRoute }}]" name="sectors[r{{ $iRoute }}]" @if(old('sectors') && array_key_exists('r'.$iRoute, old('sectors')) ) checked @endif>
                    <label class="custom-control-label" for="sectors[r{{ $iRoute }}]">{{ $iRoute }}</label>
                </div>
                @endfor
            </div>

            <label class="Field-label mt-3">Traversée</label>
            <div>
                <!-- gérer le cas old!!! -->
                @for($iRoute=1; $iRoute<=$sectors['traverse'];$iRoute++)
                <div class="custom-control custom-checkbox custom-control-inline epureCheckbox">
                    <input type="checkbox" class="custom-control-input" id="sectors[t{{ $iRoute }}]" name="sectors[t{{ $iRoute }}]" @if(old('sectors') && array_key_exists('t'.$iRoute, old('sectors')) ) checked @endif>
                    <label class="custom-control-label" for="sectors[t{{ $iRoute }}]">{{ $iRoute }}</label>
                </div>
            @endfor
            </div>


            @error('sectors')
                <span class="Field-invalidFeedback" role="alert">{{ $message }}</span>
            @enderror
        </section>

    
</form>
<div class="container">
    <button class="mt-2 btn btn-dark float-right" type="submit" onclick="event.preventDefault(); document.getElementById('blog-form').submit();">Ajouter</button>
    <a class="mt-2 btn btn-link float-right" href="{{ route('room') }}">Annuler</a>
</div>
@endsection