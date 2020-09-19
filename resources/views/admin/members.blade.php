@extends('layouts.app', ['requirementsJs' => ['app', 'admin']])

@section('title', 'Liste des licenciés')
@section('content')
<script>
const members = <?php echo $members ?>;
</script>
<div class="AdminLayout container d-flex flex-column align-items-center justify-content-center">
    <div class="col-md-10">
        <section class="PageIntro">
            <a class="PageIntro-backlink" href="{{ route('adminPanel') }}">Panel admin</a>
            <h1 class="PageIntro-title">Liste des licenciés</h1>
            <p class="PageIntro-paraph">Seuls les grimpeurs sur cette liste peuvent créer un compte sur le site, pour éviter que n'importe qui crée un compte.</p>
        </section>
        <h3 class="AdminLayout-sectionTitle">Ajouter un licencié</h3>
        <section class="AdminLayout-membersList">
            <div class="MemberCard">
                <div class="MemberCard-header">
                    <input class="MemberCard-name" placeholder="Nom, ex: Adam Ondra">
                    <input class="MemberCard-class mr-3" placeholder="Classe, ex: T°4">
                </div>
                <div class="MemberCard-actions">
                    <button class="MemberCard-add">Ajouter</button>
                </div>
            </div>
        </section>
        <h3 class="AdminLayout-sectionTitle">Licenciés actuels</h3>
        <section class="AdminLayout-membersList" id="AdminLayout-membersList">
            @foreach($members as $member)
            <div class="MemberCard col-12 col-md-6" data-name="{{$member->name}}">
                <div class="MemberCard-header">
                    <h3 class="MemberCard-name">{{$member->name}} <small>{{$member->class}}</small></h3>
                </div>
                <div class="MemberCard-actions">
                    @if($member->name !== Auth::User()->name)
                    <button class="MemberCard-delete">Supprimer</button>
                    @endif
                </div>
            </div>
            @endforeach
            @if(count($members) == 0)
                <span>Aucun licencié</span>
            @endif
        </section>
        
    </div>
</div>

@endsection