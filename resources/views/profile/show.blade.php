@extends('layouts.app')

@section('title', )
@section('content')
<div class="ProfilLayout container d-flex flex-column align-items-center justify-content-center">
    <div class="col-10 d-flex flex-column align-items-strech justify-content-center">
        <div class="ProfilCard">
            <section class="ProfilCard-identity d-flex flex-column align-items-center">
                <div class="IdentityBloc">
                    <img class="IdentityBloc-img" src="{{$user->img}}">
                    <span id="role" class="IdentityBloc-role" data-level="{{$user->level}}"></span>
                    <h1 class="IdentityBloc-name">{{$user->name}}</h1>
                </div>
            </section>

            <section class="ProfilCard-bio moreMargin d-flex flex-column align-items-center">
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