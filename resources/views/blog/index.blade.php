@extends('layouts.app')

@section('title', 'Évènements et sorties')

@section('content')
<div class="BlogsLayout container d-flex flex-column justify-content-center align-items-center">

    <div class="BlogsLayout-pageIntro">
        <section class="PageIntro col-12">
            <h1 class="PageIntro-title">Évènements et sorties</h1>
            <p class="PageIntro-paraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta non voluptas velit dolores, ea facere dolor tempore iste delectus, unde voluptatem debitis. Quos non, incidunt consectetur asperiores consequatur veniam totam!</p>
            @if(Auth::check() && Auth::user()->level>1) 
                <div class="PageIntro-actions">
                    @if(Auth::user()->level>2) 
                        <a href="{{ route('createBlog') }}" class="btn btn-outline-success border-0">Créer un blog</a>
                    @endif
                    <a href="{{ route('createPost') }}" class="btn btn-success">Nouveau post</a>
                </div>
            @endif
        </section>
    </div>

    <div class="BlogsLayout-blogs d-flex flex-row">
        <div class="BlogsList regularsBlogs col-6">
            <h2 class="BlogsList-title">Sessions et évènements réguliers</h2>
            <div class="BlogsList-blogs">
                @foreach($regulars as $blog) 
                    <section class="Blog">
                        <a href="{{ route('showBlog', ['blog'=>$blog->slug]) }}">
                            <h3 class="Blog-name">{{$blog->name}}</h3>
                            <p class="Blog-desc">{{$blog->description}}</p>
                        </a>
                        @if(Auth::check() && Auth::user()->level>2)
                            <div class="Blog-adminActions">
                                <a href="{{ route('editBlog', ['blog'=>$blog->slug]) }}" class="btn edit-blog"><img src="/assets/svg/edit-2.svg"></a>
                            </div>
                        @endif
                    </section>
                @endforeach 
            </div>
        </div>

        <div class="BlogsList nonRegularsBlogs col-6">
            <h2 class="BlogsList-title">Sorties spontanées</h2>
            <div class="BlogsList-blogs">
                @foreach($non_regulars as $blog) 
                <section class="Blog">
                    <a href="{{ route('showBlog', ['blog'=>$blog->slug]) }}">
                        <h3 class="Blog-name">{{$blog->name}}</h3>
                        <p class="Blog-desc">{{$blog->description}}</p>
                    </a>
                    @if(Auth::check() && Auth::user()->level>2)
                        <div class="Blog-adminActions">
                            <a href="{{ route('editBlog', ['blog'=>$blog->slug]) }}" class="btn edit-blog"><img src="/assets/svg/edit-2.svg"></a>
                        </div>
                    @endif
                </section>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection