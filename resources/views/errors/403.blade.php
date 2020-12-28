@extends('layouts.app', ['requirementsJs' => ['app']])


@section('title', 'Accès refusé')
@section('content')
<div class="ErrorLayout container">
    <div class="col-md-6 mx-auto">
        <img class="illustration" src="{{ asset('assets/svg/security.svg') }}" alt="">
        <h1 class="ErrorLayout-title">Accès refusé</h1>
        <h2 class="ErrorLayout-code">Erreur 403</h2>
        <p class="ErrorLayout-desc">Vous n'êtes pas autorisé à accéder à cette page.</p>
    </div>
</div>
@endsection