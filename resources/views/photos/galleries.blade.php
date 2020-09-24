@extends('layouts.app', ['requirementsJs' => ['app']])

@section('title', "Galerie photo")
@section('content')
<div class="GalleryLayout container">
    @include('components.alert')
    <div class="GalleryLayout-pageIntro col-md-12 mx-auto">
        <section class="PageIntro">
            <a href="{{ route('galleries') }}" class="PageIntro-backlink">Galeries</a>
            <h1 class="PageIntro-title">
                Galeries
            </h1>
            @if(Auth::check() && Auth::user()->level>2)
                <div class="flex flex-row">
                    <a href="{{ route('createGallery') }}"><button class="btn btn-success mb-2">Créer une galerie</button></a>
                </div>
            @endif
            <p class="PageIntro-paraph">
            </p>
        </section>
    </div>

    <div class="row col-md-12 mx-auto">
    @foreach($galleries as $gallery)
        <div class="col-sm-4 mt-4">
            <article class="card border-0 xs m-2 gallery">
                <!-- <img class="card-img-top" src="/res/blank.png" data-src="{{ $gallery->preview }}" alt="Card image cap"> -->
                <a href="{{ route('showGallery', $gallery->slug) }}" class="card-link"><img class="card-img-top rounded" src="{{ $gallery->preview }}" alt="Card image cap"></a>
                <div class="card-body">
                    <h5 class="card-title mb-0"><a href="{{ route('showGallery', $gallery->slug) }}" class="text-dark">{{$gallery->name}}</a></h5>
                    @if (Auth::check())
                    <a class="mt-2" href="{{ route('editGallery', $gallery->slug) }}" class="card-link text-success">Editer</a>
                    @endif
                </div>
            </article>
        </div>
    @endforeach
    </div>
</div>
@endsection