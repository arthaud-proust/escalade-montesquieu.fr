@extends('layouts.app', ['requirementsJs' => ['app']])

@section('title', 'Voir la salle')

@section('content')
<script>var link=document.createElement('link');link.rel='stylesheet';if(window.screen.width < 768) {link.href="/css/room3d/mobile.css";} else {link.href="/css/room3d/large.css";}document.getElementsByTagName('head')[0].appendChild(link)</script>   

</script>
<script>
    const routesData = [
        {diff:'6c',color:'purple', sectors:['r1','r2']},
        {diff:'4a',color:'red', sectors:['r1']},
        {diff:'5a',color:'green', sectors:['r2']},
    ];
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
</div>


<script src="/js/room3d.js"></script>
@endsection