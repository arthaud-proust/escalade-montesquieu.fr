<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" itemscope itemtype="http://schema.org/WebPage">
<head prefix="og: http://ogp.me/ns#">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if(View::hasSection('title'))
            @yield('title') - 
        @endif 
        {{config('app.name')}}
    </title>

    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "Organization",
        "name": "Escalade Montesquieu",
        "url": "https://escalade-montesquieu.fr",
        "address": "5 Place Longchamps 4 et 33000 Bordeaux",
        "sameAs": [
        "https://www.facebook.com/escalademontesquieu/",
        "https://www.instagram.com/escalade_montesquieu/",
        "https://twitter.com/MontesEscalade",
        "https://www.linkedin.com/in/arthaud-proust/"
        ]
    }
    </script>



    <meta name="keywords" content="montesquieu, lycée, bordeaux, escalade, section, grimpe, développeur, association, sportive, as, arthaud, proust">
    <meta name="description" content="{{ config('app.description') }}" />
    <meta name="author" content="Arthaud Proust">
    <meta name="subject" content="Escalade">
    <meta name="language" content="FR">
    <meta name="url" content="https://escalade-montesquieu.fr" />
    <meta name="identifier-URL" content="https://escalade-montesquieu.fr">
    <meta name="owner" content="Arthaud Proust">
    <meta name="target" content="all">
    <meta name="robots" content="all" />
    <meta name="theme-color" content="#222">


        <!-- Open graph Meta -->
    <meta property="og:title" content="{{ config('app.name') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="{{ config('app.description') }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <meta property="og:url" content="https://escalade-montesquieu.fr" />
    <meta property="og:locale" content="fr_FR" />
    <meta property="og:image" content="https://escalade-montesquieu.fr/assets/img/hero@0.5x.jpg"/>
    

        <!-- Twitter Meta Card -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="https://escalade-montesquieu.fr" />
    <meta name="twitter:title" content="{{ config('app.name') }}" />
    <meta name="twitter:description" content="{{ config('app.description') }}" />
    <meta name="twitter:image" content="https://escalade-montesquieu.fr/assets/img/hero@0.5x.jpg">

      <!-- Apple meta -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#222" />
    <meta name="apple-mobile-web-app-title" content="{{ config('app.name') }}" />
    <link rel="apple-touch-icon" href="/assets/img/apple/apple-touch-icon.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="/assets/img/apple/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/img/apple/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/img/apple/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="/assets/img/apple/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="/assets/img/apple/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="/assets/img/apple/apple-touch-icon-152x152.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/apple/apple-touch-icon-180x180.png" />



    <link rel="icon" href="/assets/img/favicon.ico">
    <meta http-equiv="content-language" content="fr" />
    <link rel="canonical" href="https://escalade-montesquieu.fr/" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;700&display=swap" rel="stylesheet">


    <!-- Scripts -->
    <script src="{{ asset('js/manifest.js') }}" defer></script>
    <script src="{{ asset('js/vendor.js') }}" defer></script>

    @if (app()->environment('production'))
        @foreach($requirementsJs as $requirement)
            <script src="{{ asset('js/'.$requirement.'.min.js') }}" defer></script>
        @endforeach
        @if(Auth::check())
            <script src="{{ asset('js/client.min.js') }}" defer></script>
        @endif

        <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    @else
        @foreach($requirementsJs as $requirement)
            <script src="{{ asset('js/'.$requirement.'.js') }}" defer></script>
        @endforeach
        @if(Auth::check())
            <script src="{{ asset('js/client.js') }}" defer></script>
        @endif
    
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endif
    <!-- Styles -->
    <script>
        window.onload = function() {try{var link=document.createElement('link');link.rel='stylesheet';if(window.screen.width < 768) {link.href="{{ asset('css/mobile.css') }}";} else {link.href="{{ asset('css/large.css') }}";}document.getElementsByTagName('head')[0].appendChild(link);link.addEventListener('load', function () {document.getElementById('app').setAttribute('class', '');})}catch(e) {document.getElementById('app').setAttribute('class', '')}};
    </script>
    <style>
        #app.loading {height: 100vh;overflow: hidden;}#app.loading::before {content: '';position: fixed;top:0;left: 0;background:#f8f8f8;height: 100vh;width:100vw;z-index: 9999;}#app.loading::after {content: 'Chargement...';font-weight: 600;position: fixed;top:50%;left: 50%;background:#f8f8f8;z-index: 9999;transform: translate(-50%, -50%);-webkit-transform: translate(-50%, -50%);-moz-transform: translate(-50%, -50%);-ms-transform: translate(-50%, -50%);-o-transform: translate(-50%, -50%);animation: load 2s infinite;}@keyframes load {0% {content: 'Chargement';}25% {content: 'Chargement.';}50% {content: 'Chargement..';}75% {content: 'Chargement...';}100% {content: 'Chargement';}}
    </style>
    <noscript>
        <link href="{{ asset('css/mobile.css') }}" rel="stylesheet" media="screen and (max-width:768px)">
        <link href="{{ asset('css/large.css') }}" rel="stylesheet" media="screen and (min-width:769px)">
    </noscript>
</head>
<body>
    <div id="app" class="@if(!\Request::is('photos/*')&&!\Request::is('photos'))loading @endif">
        <div class="loading-frame"></div>
        @if(!View::hasSection('noHeader'))
            @include('layouts.header')
        @endif

        <main>
            @if (!\Request::is('/'))
                <div class="container">
                    @include('components.alert')
                </div>
            @endif
            @yield('content')
        </main>

        @if(!View::hasSection('noFooter'))
            @include('layouts.footer')
        @endif
    </div>
</body>
</html>
