@extends('layouts.app')

@section('title', "Accueil")
@section('content')
<script>
const posts = <?php echo $comingPosts ?>;
const user = @if(Auth::check()) {'name':"{{Auth::user()->name}}", 'level':{{Auth::user()->level}}} @else undefined @endif;
</script>
<div class="container">
    <div class="justify-content-center">
        <div class="hero">
            <img class="hero-img" src="{{ asset('assets/img/hero.jpg') }}"> 
            <div class="title-container">
                <h1 class="title">Lycée Montesquieu</h1>
            </div>
        </div>
        
        <div class="d-flex">
            <div class="events col-7">
                <h2 class="title">Évènements et sorties à venir</h2>
                <p class="paraph">Les événements sont classés par deux catégories: réguliers ou occasionnels. Vous pouvez retrouver toutes les sorties et les événements prévus dans le <a href="/blog">blog</a>.</p>

                <div class="PostsList">
                    @foreach($comingPosts as $post)
                    <section class="PostCard" id="post-{{$post->id}}" data-show-datetime="false">
                        <div class="PostCard-content">
                        </div>
                    </section>
                    @endforeach 
                    <p class="text-center pt-3"><a href="{{ route('blogs') }}">Voir toutes les dates</a></p>
                </div>
            </div>
            
            <div class="forum-list col-5">
                <div class="forums-desc">
                    <h2 class="title">Forum</h2>
                    <p class="paraph">Plus besoin de créer des groupes whatsapp à tout bout de champ, vous pouvez discuter entre grimpeurs directement ici.</p>
                </div>
                <div class="forums d-flex justify-content-center align-items-start flex-wrap">
                    @foreach($forums as $forum) 
                    <x-forum-card :forum="$forum"/>
                    @endforeach 
                </div>
            </div>

        </div>
        
</div>
<script src="/js/blog.js" defer></script>
@endsection
