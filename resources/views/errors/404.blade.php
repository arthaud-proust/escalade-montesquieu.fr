@extends('layouts.app', ['requirementsJs' => ['app']])

@section('title', 'Page introuvable')
@section('content')
<div class="ErrorLayout container">
    <div class="col-md-6 mx-auto">
        <img class="illustration" src="{{ asset('assets/svg/warning.svg') }}" alt="">
        <h1 class="ErrorLayout-title">Page introuvable</h1>
        <h2 class="ErrorLayout-code">Erreur 404</h2>
        <?php 
        use Illuminate\Support\Str;
        use Illuminate\Support\Arr;
        $allRoutes = Route::getRoutes()->get();
        $altRoutes = [];

        function hasMiddleware($route, $middleware) {
            $middlewares = collect($route->gatherMiddleware())->map(function ($middleware) {
                return $middleware instanceof Closure ? 'Closure' : $middleware;
            });
            return in_array($middleware, $route->gatherMiddleware());
        }

        foreach($allRoutes as $route) {
            if ((implode('|', $route->methods()) == "GET|HEAD" && Str::contains($route->getName(), Request::path())) ||
                (implode('|', $route->methods()) == "GET|HEAD" && !Str::contains($route->uri(), '{') && Str::contains($route->uri(), Request::path()))) {
                $altRoutes[] = $route; 
                // echo('<p>'.hasMiddleware($route, 'level-admin').'</p>');
            }
            
        }
        if(count($altRoutes)==0) {
            echo('<p class="ErrorLayout-desc">La page que vous cherchez n\'existe pas.</p>');
        } else {
            echo('<p class="ErrorLayout-desc">La page que vous cherchez n\'existe pas. <br>Peut-être cherchez-vous à aller sur une de ces pages:</p>');
            echo('<ul class="ErrorLayout-altLinks">');
            foreach($altRoutes as $route) {
                echo('<li><a href="/'.$route->uri().'">'.$route->getName().'</a></li>');
            }
            echo('</ul>');
        }
        ?>
    </div>
</div>
@endsection
