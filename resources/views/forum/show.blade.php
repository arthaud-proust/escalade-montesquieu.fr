@extends('layouts.app', ['requirementsJs' => ['app','forum']])

@section('title', $forum->name)
@section('noFooter', '')
@section('content')
<script>
window._forum = "{{$forum->slug}}";
window._messages = <?php echo $messages ?>;
window._user = @if(Auth::check()) "{{Auth::user()->name}}" @else undefined @endif;
</script>
<div class="ForumLayout container">
    <div class="ForumLayout-pageIntro col-md-10 mx-auto">
        <section class="PageIntro">
            <a href="{{ route('forums') }}" class="PageIntro-backlink">Forum</a>
            <h1 class="PageIntro-title">
                {{$forum->name}}
                @if(Auth::check() && Auth::user()->level>2)
                    <a href="{{ route('editForum', ['forum'=>$forum->slug]) }}" class="adminAction btn edit"><img src="/assets/svg/edit-2.svg"></a>
                @endif
            </h1>
            <p class="PageIntro-paraph">{{$forum->description}}</p>
        </section>
    </div>

    <div class="ForumLayout-messagesList col-md-10 mx-auto">
        <section class="MessagesList d-flex flex-column align-items-start" id="MessagesList">
        </section>
    </div>

    <div class="ForumLayout-messageForm col-md-10 mx-auto" id="ForumLayout-messageForm">
        <section class="MessageForm">
            <input class="MessageForm-input" type="text" id="MessageForm-input" placeholder="Votre message...">
            <button class="MessageForm-send" id="MessageForm-send">
                <span class="d-none d-md-inline">Envoyer</span>
                <img class="d-md-none d-inline pr-1" src="{{ asset('assets/svg/send.svg') }}" alt=">">
            </button>
        </section>
    </div>
</div>
@endsection