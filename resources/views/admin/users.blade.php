@extends('layouts.app', ['requirementsJs' => ['app', 'admin']])

@section('title', 'Gestion des utilisateurs')
@section('content')
<div class="AdminLayout container d-flex flex-column align-items-center justify-content-center">
    <div class="col-md-10">
        <section class="PageIntro">
            <a class="PageIntro-backlink" href="{{ route('adminPanel') }}">Panel admin</a>
            <h1 class="PageIntro-title">Gestion des utilisateurs</h1>
            <p class="PageIntro-paraph">Les grimpeurs (ou utilisateurs simples) peuvent uniquement participer à un évènement, poster un message dans un forum et modifier leur profil.</p>
            <p class="PageIntro-paraph">Les modérateurs peuvent également créer un évènement, le modifier, le supprimer et voir qui y participe.</p>
            <p class="PageIntro-paraph">Les administrateurs peuvent en plus créer, éditer, supprimer une catégorie d'évènement et un sujet de discussion, accéder au panel admin.</p>
        </section>
        <h3 class="AdminLayout-sectionTitle">Administrateurs</h3>
        <section class="AdminLayout-usersList">
            @foreach($admins as $user)
                <x-user-card :user=$user/>
            @endforeach
            @if(count($admins) == 0)
                <span>Aucun administrateur</span>
            @endif
        </section>
        <hr>
        <h3 class="AdminLayout-sectionTitle">Modérateurs</h3>
        <section class="AdminLayout-usersList">
            @foreach($modos as $user)
                <x-user-card :user=$user/>
            @endforeach
            @if(count($modos) == 0)
                <span>Aucun modérateur</span>
            @endif
        </section>
        <hr>
        <h3 class="AdminLayout-sectionTitle">Grimpeurs</h3>
        <section class="AdminLayout-usersList">
            @foreach($users as $user)
                <x-user-card :user=$user/>
            @endforeach
            @if(count($users) == 0)
                <span>Aucun utilisateur/grimpeur</span>
            @endif
        </section>
    </div>
</div>

@endsection