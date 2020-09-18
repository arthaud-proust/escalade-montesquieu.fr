@extends('layouts.app', ['requirementsJs' => ['app', 'admin']])

@section('title', 'Modifier les informations à la une')
@section('content')
<div class="AdminLayout container d-flex flex-column align-items-center justify-content-center">
    <div class="col-md-10">
        <section class="PageIntro">
            <a class="PageIntro-backlink" href="{{ route('adminPanel') }}">Panel admin</a>
            <h1 class="PageIntro-title">Modifier les informations à la une</h1>
            <p class="PageIntro-paraph">Ajoutez, éditez ou supprimez une information sur la page d'accueil.</p>
            <div class="InfoCard pt-1">
                <div class="InfoCard-actions">
                    <button class="InfoCard-add">Ajouter</button>
                </div>
            </div>
        </section>
        <h3 class="AdminLayout-sectionTitle">Informations actuelles :</h3>
        <section class="AdminLayout-infosList" id="AdminLayout-infosList">
            @foreach($infos as $info)
            <div class="InfoCard" data-id="{{$info->id}}">
                <div class="InfoCard-body">
                    <h3 class="InfoCard-title">{{$info->title}}</h3>
                    <div class="InfoCard-actions mb-2">
                        <button class="InfoCard-edit">Editer</button>
                        <button class="InfoCard-delete">Supprimer</button>
                    </div>
                    <div class="InfoCard-content col-8">
                        {!! $info->content !!}
                    </div>
                </div>
                
            </div>
            @endforeach
            @if(count($infos) == 0)
                <span>Aucune info à la une</span>
            @endif
        </section>

        <div class="modal" id="modalEdit" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editer l'information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>Titre</label>
                    <input class="InfoCard-title col-12" placeholder="Titre de l'information">
                    <label class="mt-3">Contenu</label>
                    <textarea rows=10 class="InfoCard-content col-12"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="editInfo">Enregistrer</button>
                </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection