@extends('layouts.app', ['requirementsJs' => ['app','user']])

@section('title', 'Mon profil')
@section('content')
<div class="ProfilLayout container d-flex flex-column align-items-center justify-content-center">
    <div class="col-md-10 d-flex flex-column align-items-strech justify-content-center">
        <div class="ProfilCard">
            <section class="ProfilCard-identity d-flex flex-column align-items-center">
                <div class="IdentityBloc">
                    <img class="IdentityBloc-img" src="/profil/{{$user->uuid}}/img">
                    <span id="role" class="IdentityBloc-role" data-level="{{$user->level}}"></span>
                    <h1 class="IdentityBloc-name">{{$user->name}}</h1>
                    <span class="IdentityBloc-email">{{$user->email}}</span>
                </div>
            </section>

            <section class="ProfilCard-actions">
                <div class="left">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" id="disconnect" class="btn btn-outline-danger">Se déconnecter</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
                <div class="right">
                    <a href="{{ route('changePassword') }}" id="changePassword" class="btn btn-dark">Changer de mot de passe</a>
                    <a href="{{ route('editProfile') }}" id="modifyProfil" class="btn btn-dark">Modifier le profil</a>
                </div>
            </section>

            <section class="ProfilCard-bio d-flex flex-column align-items-center">
                <blockquote class="px-3">{{$user->bio==''?'Biographie vide':$user->bio}}</blockquote>
            </section>

            <section class="ProfilCard-info col-12 col-md-10 d-flex flex-column flex-column flex-md-row justify-content-between mx-auto">
                <div class="InfoBloc">
                    <h3 class="InfoBloc-title">Cotation max</h3>
                    <span class="InfoBloc-content">
                        @if(!$user->display_max)
                            Information privée
                        @elseif($user->max_voie=="Non renseigné" && $user->max_bloc == "Non renseigné")
                            Non renseigné
                        @else
                            {{$user->max_voie}} en voie et {{$user->max_bloc}} en bloc
                        @endif
                    </span>
                </div>
                <div class="InfoBloc mt-4 mt-md-0">
                    <h3 class="InfoBloc-title">Équipement</h3>
                    <span class="InfoBloc-content">
                        @if($user->harness)
                            J'emprunte un baudrier
                        @else
                            J'ai mon baudrier
                        @endif

                        @if($user->shoes == 'no-need')
                            et j'ai mes chaussures
                        @else 
                            et il me faut du {{$user->shoes}}
                        @endif
                    </span>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection