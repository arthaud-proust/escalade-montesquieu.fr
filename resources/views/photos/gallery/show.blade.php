@extends('layouts.app', ['requirementsJs' => ['app']])

@section('title', $gallery? $gallery->name: "Photo")


@section('content')
<div class="PhotoLayout container">
    <div class="PhotoLayout-pageIntro col-md-12 mx-auto">
        <section class="PageIntro">
            <a href="{{ route('galleries') }}" class="PageIntro-backlink">Toutes les galeries</a>
            <h1 class="PageIntro-title">
                {{ $gallery->name }}
            </h1>
            @if(Auth::check() && Auth::user()->level>2)
                <div class="flex flex-row">
                    <a href="{{ route('editGallery', $gallery->slug) }}"><button class="btn btn-outline-success mb-2">Editer</button></a>
                    <a href="{{ route('createPhoto', ['gallery'=>$gallery->name]) }}"><button class="btn btn-success ml-2 mb-2">Ajouter une photo</button></a>
                </div>
            @endif
            <p class="PageIntro-paraph">{{ $gallery->text }}</p>
        </section>
    </div>
   

    <div class="row col-md-12 mx-auto">
        @foreach ($photos as $photo)
        <div class="col-sm-4 py-3">
            <article class="card xs border-0">
                <a href="{{ route('showPhoto', $photo->slug) }}"><img class="card-img-top rounded lazyload" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{$photo->src}}" alt=" "></a>
                <div class="card-body ">
                    @if($photo->name)<h5 class="card-title"><a href="{{ route('showPhoto', $photo->slug) }}" class="text-dark">{{$photo->name}}</a></h5>@endif
                    @if($photo->text)<p class="card-text">{{$photo->text}}</p>@endif
                    @if(Auth::check())<a href="{{ route('editPhoto', $photo->slug) }}" class="card-link text-success">Editer</a>@endif
                </div>
            </article>
        </div>
        @endforeach
    </div>

    @if( count($photos) == 0)
    <div class="jumbotron">
        <h1 class="display-4">C'est vide ici !</h1>
        <hr class="my-4">
        <p class="lead">Des photos arrivent bientôt.</p>
        <p class="lead float-right">
            <a class="btn btn-primary mt-2" href="{{ route('galleries') }}" role="button">Retourner voir les autres galleries</a>
        </p>
    </div>
    @endif
</main>

@endsection
