@extends('layouts.app')

@section('title', 'Liste des forums')
@section('content')
<div class="ForumsLayout container">
    <div class="ForumsLayout-pageIntro d-flex flex-column align-items-center">
        <section class="PageIntro col-10">
            <h1 class="PageIntro-title">Sujets de discussion</h1>
            <p class="PageIntro-paraph">Plus besoin de créer des groupes whatsapp à tout bout de champ, vous pouvez discuter entre grimpeurs directement ici.</p>
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