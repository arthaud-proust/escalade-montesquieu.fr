@extends('layouts.app', ['requirementsJs' => ['app', 'blog']])

@section('title', "Accueil")
@section('content')
@php
// dd($exposedPhotos);
@endphp
<script>
const posts = <?php echo $comingPosts ?>;
const user = @if(Auth::check()) {'name':"{{Auth::user()->name}}", 'level':{{Auth::user()->level}}} @else undefined @endif;
</script>
<div class="container">
    <div class="justify-content-center">
        <div class="hero" id="hero">
            <div class="title-container">
                <h1 class="title d-md-none">Lycée Montesquieu</title>
            </div>
            <div id="carousel" class="carousel slide mb-4 mb-md-0" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel" data-slide-to="0" class="active"></li>
                    @for ($i=1;count($exposedPhotos)+1>$i;$i++)
                    <li data-target="#carousel" data-slide-to="{{$i}}"></li>
                    @endfor
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item rounded active" data-interval="2000">
                        <img class="m-auto d-block rounded mw-100 lazyload" style="max-height:90vh" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('assets/img/hero.jpg') }}" alt=" ">
                    </div>
                    @foreach ($exposedPhotos as $photo)
                        <div class="carousel-item rounded" data-interval="6000">
                            <img class="m-auto d-block rounded mw-100 lazyload" style="max-height:55vh" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{$photo->src}}" alt=" ">
                            <div class="carousel-caption d-none d-md-block">
                                @if($photo->name)<h5>{{$photo->name}}</h5>@endif
                                <p>{{ $photo->galleryObj->name }}@if($photo->text) {{$photo->text}}@endif</p>
                                @if(Auth::check())<a href="{{ route('editPhoto', $photo->slug) }}" class="card-link btn btn-success">Editer</a>@endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @include('components.alert')

        

        <div class="d-flex flex-column flex-md-row align-items-start">
            <div class="leftpan flex flex-column col-md-7">
                @if(count($infos) > 0)
                <div class="info d-flex flex-column">
                    @foreach($infos as $info)
                    <div class="infoCard pb-4">
                        <h2 class="title">{{$info->title }}</h2>
                        <p class="paraph">{{$info->content }}</p>
                    </div>
                    @endforeach
                    @if(Auth::check() && Auth::user()->level>2)
                        <p class="text-center mb-5"><a href="{{ route('adminInfos') }}">Éditer les informations à la une</a></p>
                    @endif
                </div>
                @endif

                <div class="events ">
                    <h2 class="title">Évènements à venir</h2>
                    <p class="paraph">Les évènements sont classés par deux catégories: réguliers ou occasionnels. Vous pouvez retrouver toutes les sorties et les événements prévus <a href="{{ route('blogs') }}">ici</a>.</p>
                    @include('components.alert-status')

                    <div class="PostsList">
                        @foreach($comingPosts as $post)
                        <section class="PostCard" id="post-{{$post->id}}" data-show-datetime="false">
                            <div class="PostCard-content">
                            </div>
                        </section>
                        @endforeach
                        @if(count($comingPosts) ==0) 
                            <img class="illustration-small" src="{{ asset('assets/svg/empty.svg') }}" alt="">
                            <span class="illustration-title">Aucun évènement à venir</span>
                        @endif
                        <p class="text-center pt-3"><a href="{{ route('blogs') }}">Voir toutes les dates</a></p>
                    </div>
                </div>
            </div>
            
            <div class="forum-list col-md-5">
                <div class="forums-desc">
                    <h2 class="title">Forum</h2>
                    <p class="paraph">Plus besoin de créer des groupes whatsapp à tout bout de champ, vous pouvez discuter entre grimpeurs directement ici.</p>
                </div>
                <div class="forums d-flex flex-column justify-content-center align-items-stretch">
                    @foreach($forums as $forum) 
                    <x-forum-card :forum=$forum/>
                    @endforeach 
                </div>
            </div>

        </div>
    </div>
</div>
<script>
if(window.screen.width >= 768) {
    /* 
    var img=document.createElement('img');
    img.src='{{ asset('assets/img/hero.jpg') }}';
    img.setAttribute('alt',"");
    img.setAttribute('class',"hero-img");
    document.getElementById('hero').appendChild(img);
    */
}
</script>
@endsection
