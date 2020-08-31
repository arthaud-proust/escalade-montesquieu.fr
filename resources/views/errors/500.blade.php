@extends('layouts.app')

@section('title', 'Problème interne')
@section('content')
<div class="ErrorLayout container">
    <div class="col-6 mx-auto">
        <h1 class="ErrorLayout-title">Problème interne</h1>
        <h2 class="ErrorLayout-code">Erreur 500</h2>
        <p class="ErrorLayout-desc">Le serveur a rencontré un problème interne. Nous sommes en train d'y remédier.</p>
    </div>
</div>
@endsection
