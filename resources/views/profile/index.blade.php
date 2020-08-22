@extends('layouts.app')

@section('title', 'Mon profil')
@section('content')
<div class="ProfilLayout container d-flex flex-column align-items-center justify-content-center">
    <div class="col-10 d-flex flex-column align-items-strech justify-content-center">
        <div class="ProfilCard">
            <section class="ProfilCard-identity d-flex flex-column align-items-center">
                <div class="IdentityBloc">
                    <img class="IdentityBloc-img" src="{{$user->img}}">
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
                    <!-- <a href="{{ route('userProfile', ['user_uuid'=>$user->uuid]) }}" class="btn btn-link">Lien du profil</a> -->
                </div>
            </section>

            <section class="ProfilCard-bio d-flex flex-column align-items-center">
                <blockquote class="col-10">{{$user->bio}}</blockquote>
            </section>

            <section class="ProfilCard-info d-flex flex-row justify-content-between col-10 mx-auto">
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
                <div class="InfoBloc">
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
<script src="{{ asset('js/user.js') }}" defer></script>

@endsection