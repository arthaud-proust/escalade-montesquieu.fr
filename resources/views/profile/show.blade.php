@extends('layouts.app', ['requirementsJs' => ['app','user']])

@section('title', )
@section('content')
<div class="ProfilLayout container d-flex flex-column align-items-center justify-content-center">
    <div class="col-md-10 d-flex flex-column align-items-strech justify-content-center">
        <div class="ProfilCard">
            <section class="ProfilCard-identity d-flex flex-column align-items-center">
                <div class="IdentityBloc">
                    <img class="IdentityBloc-img" src="/profil/{{$user->uuid}}/img">
                    <span id="role" class="IdentityBloc-role" data-level="{{$user->level}}"></span>
                    <h1 class="IdentityBloc-name">{{$user->name}}</h1>
                </div>
            </section>

            <section class="ProfilCard-bio moreMargin d-flex flex-column align-items-center">
                <blockquote class="px-3">{{$user->bio==''?'Biographie vide':$user->bio}}</blockquote>
            </section>

            <section class="ProfilCard-info col-12 col-md-10 d-flex flex-column flex-md-row justify-content-between mx-auto">
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