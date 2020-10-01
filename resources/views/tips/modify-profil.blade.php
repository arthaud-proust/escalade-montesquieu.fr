@extends('layouts.app', ['requirementsJs' => ['app', 'blog']])

@section('noHeader', '')
@section('noFooter', '')
@section('title', "Modifiez votre profil")
@section('content')
<div class="TipsLayout container d-flex flex-column align-items-center justify-content-center">
    <div class="col-md-8 d-flex flex-column align-items-strech justify-content-center">
        <div class="TipsCard large">
            <h1 class="TipsCard-title">Avez-vous votre matériel?</h1>
            <p>Lorsque vous cliquez sur le bouton <b>Participer</b> d'un évènement, votre nom et le matériel qu'il vous faut s'ajoutent à une liste.</p>
            <p>Par défaut, il est marqué dans votre profil que vous n'avez besoin de rien. Il est donc important pour la suite d'<b>indiquer si vous avez un baudrier et des chaussures dans votre profil</b>.</p>
        </div>

        <div class="TipsLayout-actions d-flex flex-column-reverse flex-md-row align-items-strectch justify-content-end">
            <!-- <a href="{{ route('home') }}" class="btn btn-white backlink">Plus tard</a> -->
            <a href="{{ route('editProfile') }}" class="btn btn-success" type="submit">Modifier mon profil</a>
        </div>
    </div>
</div>

@endsection
