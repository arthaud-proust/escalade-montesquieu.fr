@extends('layouts.app')

@section('title', 'Liste des forums')
@section('content')
<div class="ForumsLayout container">
    <div class="ForumsLayout-pageIntro d-flex flex-column align-items-center">
        <section class="PageIntro col-10">
            <h1 class="PageIntro-title">Sujets de discussion</h1>
            <p class="PageIntro-paraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto quasi, debitis atque fugit doloremque enim tenetur! Aspernatur veritatis voluptate ea quibusdam! Necessitatibus ipsa vel voluptate ex nostrum dolorem eum autem?</p>
            @if(Auth::check() && Auth::user()->level>2) 
                <div class="PageIntro-actions">
                    <a href="{{ route('createForum') }}" class="btn btn-success">Nouveau sujet</a>
                </div>
            @endif
        </section>
    </div>
    <!-- <div class="ForumsLayout-forums d-flex justify-content-center align-items-start flex-wrap"> -->
    <div class="ForumsLayout-forums d-flex flex-column align-items-center">
        <div class="ForumsList col-10">
            @foreach($forums as $forum) 
                <x-forum-card :forum="$forum"/>
            @endforeach 
        </div>
    </div>
</div>
@endsection