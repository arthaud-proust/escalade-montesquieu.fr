@extends('layouts.app', ['requirementsJs' => ['app', 'admin']])

@section('title', 'Panel admin')
@section('content')
<div class="AdminLayout container d-flex flex-column align-items-center justify-content-center">
    <div class="col-md-10">
        <section class="PageIntro">
            <h1 class="PageIntro-title">Panel admin</h1>
            <p class="PageIntro-paraph">Depuis ce panel vous pouvez modifier des informations du site et gérer les utilisateurs</p>
        </section>
        <section class="AdminLayout-links d-flex flex-column">
            <a class="py-2" href="{{ route('adminMembers') }}">Modifier la liste des licenciés</a>
            <a class="py-2" href="{{ route('adminUsers') }}">Gérer des utilisateurs</a>
            <a class="py-2" href="{{ route('adminInfos') }}">Modifier les infos à la une</a>
        </section>
        <section class="AdminLayout-tips d-flex flex-column pt-5">
            <h4>Infos pratiques</h4>
            <p>Pour ajouter un lien dans un post ou une info à la une il suffit de marquer "titre du lien"[lien]</p>
        </section>
    </div>
</div>

@endsection