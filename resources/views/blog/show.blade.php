@extends('layouts.app')

@section('title', $blog->name)
@section('content')
<script>
const posts = <?php echo $posts ?>;
const user = @if(Auth::check()) {'name':"{{Auth::user()->name}}", 'level':{{Auth::user()->level}}} @else undefined @endif;
</script>
<div class="BlogLayout container">
    <div class="BlogLayout-pageIntro col-10 mx-auto">
        <section class="PageIntro">
            <a class="PageIntro-backlink" href="{{ route('blogs') }}">Évènements et sorties</a>
            <h1 class="PageIntro-title">
                {{$blog->name}}
                @if(Auth::check() && Auth::user()->level>2)
                <a href="{{ route('editBlog', ['blog'=>$blog->slug]) }}" class="adminAction btn edit"><img src="/assets/svg/edit-2.svg"></a>
                @endif
            </h1>
            <p class="PageIntro-paraph">{{$blog->description}}</p>
        </section>
    </div>

    <div class="BlogLayout-posts col-10 mx-auto">
        <div class="PostsList">
            @foreach($posts->reverse() as $post) 
                <section class="PostCard" id="post-{{$post->id}}" data-show-datetime="false">
                    <div class="PostCard-content">
                    </div>
                    @if(Auth::check() && Auth::user()->level>1)
                        <div class="PostCard-adminActions d-flex flex-row-reverse mb-4">
                            <a href="{{ route('editPost', ['post'=>$post->id]) }}" class="btn btn-success">Éditer</a>
                            <form action="{{ route('destroyPost', ['post'=>$post->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mx-1">Supprimer</button>
                            </form>
                        </div>
                    @endif
                </section>
            @endforeach 
        </div>
    </div>
</div>
<script src="/js/blog.js" defer></script>
@endsection