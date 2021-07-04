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
            @if(Auth::check() && Auth::user()->level>1)
                <div class="flex flex-row">
                    <a href="{{ route('editGallery', $gallery->slug) }}"><button class="btn btn-outline-success mb-2">Editer</button></a>
                    <a href="{{ route('createPhoto', ['gallery'=>$gallery->name]) }}"><button class="btn btn-success ml-2 mb-2">Ajouter une photo</button></a>
                </div>
            @endif
            <p class="PageIntro-paraph">{{ $gallery->text }}</p>
        </section>
    </div>

    @if( count($photos) > 0)
    <div id="carousel" class="mb-5 pb-5 carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
            @foreach ($photos as $photo)
                <div class="carousel-item rounded {{ $loop->index==0?'active':''}}" data-interval="10000" style="background:{{ $photo->background }}">
                    <img class="m-auto d-block rounded mw-100 lazyload" style="max-height:90vh" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{$photo->src}}" alt=" ">
                    <div class="carousel-caption d-none d-md-block">
                        @if($photo->name)<h5>{{$photo->name}}</h5>@endif
                        @if($photo->text)<p>{{$photo->text}}</p>@endif
                        @if(Auth::check())<a href="{{ route('editPhoto', $photo->slug) }}" class="card-link btn btn-success">Editer</a>@endif
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
   

    <div class="carouselShortcuts row col-md-12 mx-auto">
        @foreach ($photos as $photo)
        <div class="col-sm-4 py-3">
            <article class="card xs border-0">
                <img class="card-img-top rounded lazyload" data-n="{{ $loop->index }}" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{$photo->src}}" alt=" ">
                <div class="card-body ">
                    @if($photo->name)<h5 class="card-title"><a href="{{ route('showPhoto', $photo->slug) }}" class="text-dark">{{$photo->name}}</a></h5>@endif
                    @if($photo->text)<p class="card-text">{{$photo->text}}</p>@endif
                    @if(Auth::check())<a href="{{ route('editPhoto', $photo->slug) }}" class="card-link text-success">Editer</a>@endif
                </div>
            </article>
        </div>
        @endforeach
    </div>

    @else
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
