@extends('layouts.app', ['requirementsJs' => ['app']])


@section('title', 'Trop de requêtes')
@section('content')
<div class="ErrorLayout container">
    <div class="col-md-6 mx-auto">
        <img class="illustration" src="{{ asset('assets/svg/server.svg') }}" alt="">
        <h1 class="ErrorLayout-title">Trop de requêtes</h1>
        <h2 class="ErrorLayout-code">Erreur 429</h2>
        <p class="ErrorLayout-desc">Le serveur a reçu trop de requêtes. Merci de réessayer plus tard.</p>
    </div>
</div>
@endsection
