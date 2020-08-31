@extends('layouts.app')

@section('title', 'Authentification nécessaire')
@section('content')
<div class="ErrorLayout container">
    <div class="col-6 mx-auto">
        <h1 class="ErrorLayout-title">Authentification nécessaire</h1>
        <h2 class="ErrorLayout-code">Erreur 401</h2>
        <p class="ErrorLayout-desc">Vous devez être connecté pour accéder à cette page.</p>
    </div>
</div>
@endsection
