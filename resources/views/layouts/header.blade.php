<header>
    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container">
            <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <img src="/assets/svg/menu.svg" alt="Menu">
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link showDropdown" href="{{ route('blogs') }}">
                            Évènements et sorties <img src="/assets/svg/chevron-down.svg" alt="&#8964;">
                        </a>
                        <div class="dropdownContent">
                        @foreach(Session::get('blog_list'); as $blog)
                            <a class="link" href="{{ route('showBlog', $blog->slug) }}">{{$blog->name}}</a>
                        @endforeach
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link showDropdown" href="{{ route('forums') }}">
                            Forum <img src="/assets/svg/chevron-down.svg" alt="&#8964;">
                        </a>
                        <div class="dropdownContent">
                        @foreach(Session::get('forum_list'); as $forum)
                            <a class="link" href="{{ route('showForum', $forum->slug) }}">{{$forum->name}}</a>
                        @endforeach
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('galleries') }}">Photos</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto d-none d-md-flex">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Créer un compte</a>
                        </li>
                    @else
                        <li class="nav-item">
                        <a class="nav-link showDropdown" href="{{ route('showProfile') }}">
                            {{Auth::user()->name}} <img src="{{Auth::user()->img}}" style="border-radius:100%" height=25px width=25px> <img src="/assets/svg/chevron-down.svg" alt="&#8964;">
                        </a>
                        <div class="dropdownContent">
                            @if(Auth::user()->level>1)<a class="link" href="{{ route('createPost') }}">Créer un post</a>@endif
                            @if(Auth::user()->level>2)<a class="link" href="{{ route('adminPanel') }}">Panel admin</a>@endif
                            <a class="link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Se déconnecter
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                        </li>
                    @endguest
                </ul>
            </div>


            <ul class="navbar-nav ml-auto float-right d-md-none">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                        </li>
                    @else
                        <li class="nav-item">
                        <a class="nav-link showDropdown">
                            {{Auth::user()->name}} <img src="{{Auth::user()->img}}" style="border-radius:100%" height=25px width=25px> <img src="/assets/svg/chevron-down.svg" alt="&#8964;">
                        </a>
                        <div class="dropdownContent">
                            <a class="link" href="{{ route('showProfile') }}">Mon profil</a>
                            @if(Auth::user()->level>1)<a class="link" href="{{ route('createPost') }}">Créer un post</a>@endif
                            @if(Auth::user()->level>2)<a class="link" href="{{ route('adminPanel') }}">Panel admin</a>@endif
                            <a class="link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Se déconnecter
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                        </li>
                    @endguest
                </ul>
        </div>
    </nav>
</header>