@extends('layouts.app', ['requirementsJs' => ['app']])

@section('title', $photo->name? $photo->name : "Image")



@section('content')

<div class="container">
    <section class="PageIntro">
        <a href="{{ route('showGallery', $photo->gallery) }}" class="PageIntro-backlink">Retour à la galerie</a>
        <h1 class="PageIntro-title">
            {{ $photo->name }}
        </h1>
    </section>
</div>

<div class="background" style="background: {{$photo->background}};">
    
    <div class="item">
        <img src="{{ $photo->src }}" class="image" alt="{{ $photo->name }}">
        <div class="content">
            <h1>{{ $photo->name }}</h1>
            @if($photo->name)
            <hr>
            @endif
            <h6>{{ $photo->gallery_name }} {{ $photo->date? "- ".$photo->date:"" }}</h6>
            <p>{{ $photo->text }}</p>
            @if (Auth::check())
            <a href="{{ route('editPhoto', $photo->slug) }}">Editer</a>
            @endif
        </div>
    </div>
</div>

<style>

.background {
    position: relative;
    background: #010203;
    height: 110vh;
    width: 100vw;
    /* padding: 50px; */
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.background * {
    box-sizing: border-box;
}

.item {
    position: relative;
    /* max-width: 100%; */
    /* max-height: 100%; */
}
.background .item *{
    transition: .5s;
}
.item .image {
    position: relative;
    height: auto;
    width: auto;
    max-width: 90vw;
    max-height: 90vh;
}

.item .content {
    position: absolute;
    top:0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;

    opacity: 0;
    background: rgba(255,255,255, 0.7);

    padding: 30px;
}

.background .item .content h1 {
    font-size: 4em;
}

.background .item .content hr {
    border: none;
    border-bottom: rgb(32, 32, 32) 0.5px solid ;
    width: 70px;
    margin: 10px;
}

.background .item .content h6 {
    font-size: 2em;
    color: rgb(34, 34, 34);
}


.background .item .content p {
    padding-top: 0px;
    color: rgb(48, 48, 48);
    font-size: 1.2em;
}
@media (max-width: 992px) { 
    .background .item .content h1 {
        font-size: 2.5em;
    }
    
    .background .item .content hr {
        border-bottom: rgb(32, 32, 32) 1px solid ;
    }
    
    .background .item .content h6 {
        font-size: 1.4em;
    }
    .background .item .content p {
        padding-top: 0px;
        color: rgb(48, 48, 48);
        font-size: 1em;
    }
}


.background .item:hover .content {
    opacity: 1;
}
</style>


@endsection

@section('nofooter', '')
