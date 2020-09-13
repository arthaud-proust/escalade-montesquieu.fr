<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if(View::hasSection('title'))
            @yield('title') - 
        @endif 
        {{config('app.name')}}
    </title>

    <!-- Scripts -->
    @foreach($requirementsJs as $requirement)
        <script src="{{ asset('js/'.$requirement.'.js') }}" defer></script>
    @endforeach

    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script>
        var link=document.createElement('link');
        link.rel='stylesheet';
        
        if(window.screen.width < 768) {
            link.href="{{ asset('css/mobile.css') }}";
        } else {
            link.href="{{ asset('css/large.css') }}";
            
        }
        document.getElementsByTagName('head')[0].appendChild(link);
        link.addEventListener('load', function () {
            document.getElementById('app').setAttribute('class', '');
        });
    </script>
    <style>
    #app.loading {
        height: 100vh;
        overflow: hidden;
    }
    #app.loading::before {
        content: '';
        position: fixed;
        top:0;
        left: 0;
        background:#f8f8f8;
        height: 100vh;
        width:100vw;
        z-index: 9999;
    }
    #app.loading::after {
        /* content: url('/assets/svg/loading.svg'); */
        content: 'Chargement...';
        position: fixed;
        top:50%;
        left: 50%;
        background:#f8f8f8;
        z-index: 9999;
        transform: translate(-50%, -50%);
        -webkit-transform: translate(-50%, -50%);
        -moz-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        -o-transform: translate(-50%, -50%);
        animation: load 2s;
    }
    @keyframes load {
        0% {
            content: 'Chargement';
        }
        25% {
            content: 'Chargement.';
        }
        50% {
            content: 'Chargement..';
        }
        75% {
            content: 'Chargement...';
        }
        100% {
            content: 'Chargement';
        }
    }
    </style>
    <noscript>
        <link href="{{ asset('css/mobile.css') }}" rel="stylesheet" media="screen and (max-width:768px)">
        <link href="{{ asset('css/large.css') }}" rel="stylesheet" media="screen and (min-width:769px)">
    </noscript>
</head>
<body>
    <div id="app" class="loading">
        @if(!View::hasSection('noHeader'))
            @include('layouts.header')
        @endif

        <main>
            @yield('content')
        </main>

        @if(!View::hasSection('noHeader'))
            @include('layouts.footer')
        @endif
    </div>
</body>
</html>
