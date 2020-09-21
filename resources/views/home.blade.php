@extends('layouts.app', ['requirementsJs' => ['app', 'blog']])

@section('title', "Accueil")
@section('content')
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
        </div>

        

        <div class="d-flex flex-column flex-md-row align-items-start">
            <div class="leftpan flex flex-column col-md-7">
                @if(count($infos) > 0)
                <div class="info d-flex flex-column">
                    @foreach($infos as $info)
                    <div class="pb-4">
                        <h2 class="title">{{$info->title }}</h2>
                        {!!$info->content !!}
                    </div>
                    @endforeach
                    @if(Auth::check() && Auth::user()->level>2)
                        <p class="text-center mb-5"><a href="{{ route('adminInfos') }}">Éditer les informations à la une</a></p>
                    @endif
                </div>
                @endif

                <div class="events ">
                    <h2 class="title">Évènements et sorties à venir</h2>
                    <p class="paraph">Les évènements sont classés par deux catégories: réguliers ou occasionnels. Vous pouvez retrouver toutes les sorties et les événements prévus dans le <a href="{{ route('blogs') }}">ici</a>.</p>

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
    var img=document.createElement('img');
    img.src='{{ asset('assets/img/hero.jpg') }}';
    img.setAttribute('alt',"");
    img.setAttribute('class',"hero-img");
    document.getElementById('hero').appendChild(img);
}
</script>
@endsection
