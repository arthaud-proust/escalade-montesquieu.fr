@extends('layouts.app', ['requirementsJs' => ['app']])

@section('title', "Galerie photo")
@section('content')
<div class="GalleryLayout container">
    <div class="GalleryLayout-pageIntro col-md-12 mx-auto">
        <section class="PageIntro">
            <h1 class="PageIntro-title">
                Galeries
            </h1>
            @if(Auth::check() && Auth::user()->level>1)
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
                <a href="{{ route('showGallery', $gallery->slug) }}" class="card-link"><img class="card-img-top rounded lazyload" data-src="{{ $gallery->preview }}" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt=" "></a>
                <div class="card-body">
                    <h5 class="card-title mb-0"><a href="{{ route('showGallery', $gallery->slug) }}" class="text-dark">{{$gallery->name}}</a></h5>
                    @if (Auth::check())
                    <a class="mt-2" href="{{ route('editGallery', $gallery->slug) }}" class="card-link text-success">Editer</a>
                    @endif
                </div>
            </article>
        </div>
    @endforeach
    @if(count($galleries) ==0) 
    <div class="flex column mx-auto">
        <img class="illustration" src="{{ asset('assets/svg/empty.svg') }}" alt="">
        <span class="illustration-title">Aucune galerie pour l'instant</span>
        </div>
    @endif
    </div>
</div>
@endsection