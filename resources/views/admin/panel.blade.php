@extends('layouts.app', ['requirementsJs' => ['app', 'admin']])

@section('title', 'Panel admin')
@section('content')
<div class="AdminLayout container d-flex flex-column align-items-center justify-content-center">
    <div class="col-md-10">
        <section class="PageIntro">
            <h1 class="PageIntro-title">Panel admin</h1>
            <p class="PageIntro-paraph">Depuis ce panel vous pouvez modifier des informations du site et gérer les utilisateurs</p>
        </section>
        <section class="AdminLayout-links">
            <a href="{{ route('adminUsers') }}">Gestion des utilisateurs</a>
        </section>
    </div>
</div>

@endsection