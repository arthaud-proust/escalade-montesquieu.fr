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

        $routesNames = array(
            'galleries' => 'Voir les galeries',
            'home' => 'Accueil',
            'mentionsLegales' => 'Mentions légales',
            'politiqueRgpd' => 'Politique Rgpd',
            'conditionsUtilisation'=>'Conditions d\'utilisation',
            'register'=>'Créer un compte',
            'login' => 'Se connecter',
            'logout' => 'Se déconnecter',
            'editProfile'=>'Éditer mon profil',
            'createGallery' => 'Créer une galerie',
            'createBlog'=>'Créer un blog',
            'createPost'=>'Créer un post',
            'createForum'=>'Créer un forum',
            'blogs'=>'Évènements et sorties',
            'forum'=>'Forum',
            'adminPanel'=>'Panel admin',
            'changePassword'=>'Changer de mot de passe',
            'showProfil'=>'Mon profil'
        );
        $allRoutes = Route::getRoutes()->get();
        $altRoutes = [];

        function hasMiddleware($route, $middleware) {
            $middlewares = collect($route->gatherMiddleware())->map(function ($middleware) {
                return $middleware instanceof Closure ? 'Closure' : $middleware;
            });
            return in_array($middleware, $route->gatherMiddleware());
        }

        foreach($allRoutes as $route) {
            if ( (implode('|', $route->methods()) == "GET|HEAD") && ( (Str::contains($route->getName(), Request::path())) ||
                (!Str::contains($route->uri(), '{') && Str::contains($route->uri(), Request::path())) )
                ) {
                $altRoutes[] = $route; 
            }
            
        }
        if(count($altRoutes)==0) {
            echo('<p class="ErrorLayout-desc">La page que vous cherchez n\'existe pas.</p>');
        } else {
            echo('<p class="ErrorLayout-desc">La page que vous cherchez n\'existe pas. <br>Peut-être cherchez-vous à aller sur une de ces pages:</p>');
            echo('<ul class="ErrorLayout-altLinks">');
            // foreach($altRoutes as $route) {
            foreach($altRoutes as $route) {
                if (array_key_exists($route->getName(), $routesNames)) {
                    echo('<li><a href="/'.$route->uri().'">'.$routesNames[$route->getName()].'</a></li>');
                }
            }
            echo('</ul>');
        }
        ?>
    </div>
</div>
@endsection
