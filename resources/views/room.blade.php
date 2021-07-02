@extends('layouts.app', ['requirementsJs' => ['app']])

@section('title', 'Voir la salle')

@section('content')

@php
$colors = [
    'yellow'=> ['#FFDD00', '#000000'],
    'red'=> ['#F93822', '#FFFFFF'],
    'blue'=> ['#0A8FD4', '#FFFFFF'],
    'black'=> ['#000000', '#FFFFFF'],
    'orange'=> ['#F68D2E', '#FFFFFF'],
    'green'=> ['#4DA358', '#FFFFFF'],
    'purple'=> ['#BB29BB', '#FFFFFF'],
    'white'=> ['#FFFFFF', '#000000'],
    'grey'=> ['#6e6e6e', '#FFFFFF'],
];

@endphp


<script>var link=document.createElement('link');link.rel='stylesheet';if(window.screen.width < 768) {link.href="/css/room3d/mobile.css";} else {link.href="/css/room3d/large.css";}document.getElementsByTagName('head')[0].appendChild(link)</script>   

</script>
<script>
    const colorsData = <?= json_encode($colors, true) ?>;

    const routesData = <?= $routes->toJson() ?>;
    @if(Auth::check() && Auth::user()->level>1)
    window.adminVersion = true;
    window.adminUrls = {
        'create': ()=>`{{ route('route.create') }}`,
        'edit': (n)=>`{{ route('route.edit', '') }}/${n}`,
    };
    @endif
</script>
<div id="renderer">
    <div id="partControls" class="needShow show">
        <button id="leftArrow" class="btn arrowBtn"></button>
        <button id="rightArrow" class="btn arrowBtn"></button>
    </div>
    <div id="sectorContainer" class="needShow">
        <div id="sectorInfo">
            <!-- <button id="sectorQuit"></button> -->
            <h1 id="sectorName"></h1>
            <h3 id="sectorOnPan">Sur ce pan</h3>
            <div id="sectorRoutes"></div>
        </div>
        <button id="sectorClose" class="btn"></button>
    </div>
    <a id="addRoute" class="btn needShow" title="Ajouter une voie/bloc"></a>
</div>


<script src="/js/room3d.js"></script>
@endsection