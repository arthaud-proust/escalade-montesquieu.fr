<section class="card-forum">
    <a href="{{ route('showForum', ['forum'=>$forum->slug]) }}">
        <h3 class="title">{{$forum->name}}</h3>
        <p class="desc">{{$forum->description}}</p>
    </a>
    @if(Auth::check() && Auth::user()->level>2)
        <!-- <a href="{{ route('editForum', ['forum'=>$forum->slug]) }}" class="btn btn-outline-success border-0">Éditer</a> -->
    @endif
</section>