@extends('layouts.app', ['requirementsJs' => ['app']])

@section('title', 'Connexion')
@section('content')
<div class="AuthLayout">
    <div class="container">
        <div class="AuthLayout-leftImg d-none d-md-block" id="leftImg">
        </div>
        <div class="AuthLayout-form col-md-7">
            <form class="AuthForm col-md-9" method="POST" action="{{ route('login') }}">
                @csrf
                <h1 class="AuthForm-title">Connexion</h1>
                <div class="FieldSection">
                    <section class="Field text @error('email') is-invalid @enderror">
                        <label class="Field-label" for="email">E-mail</label>
                        <input class="Field-input" id="email" name="email" type="email" value="{{ old('email') ? old('email') : '' }}">
                        <!-- <small class="Field-info"></small> -->
                        @error('email')
                            <span class="Field-invalidFeedback" role="alert">{{ $message }}</span>
                        @enderror
                    </section>
                    <section class="Field password @error('password') is-invalid @enderror">
                        <label class="Field-label" for="password">Mot de passe</label>
                        <input class="Field-input" id="password" name="password" type="password" value="{{ old('password') ? old('password') : '' }}">
                        <img src="/assets/svg/eye-off.svg" class="Field-toggleVisibility">
                        <!-- <small class="Field-info">Pour éviter une mauvaise manipulation</small> -->
                        @error('password')
                            <span class="Field-invalidFeedback" role="alert">{{ $message }}</span>
                        @enderror
                    </section>
                </div>
                <div class="AuthForm-actions">
                    <a href="{{ route('register') }}" class="col-md-6 btn btn-white backlink">Je n'ai pas de compte</a>
                    <button class="col-md-6 btn btn-dark" type="submit">Se connecter</button>
                </div>
            </form>
        </div>
        <div class="AuthLayout-rightImg d-none d-md-block" id="rightImg">
        </div>
    </div>
</div>
<script>
if(window.screen.width >= 768) {
    var imgLeft=document.createElement('img');
    imgLeft.setAttribute('alt',"");
    imgLeft.src='{{ asset('assets/img/auth-left-img.jpg') }}';
    document.getElementById('leftImg').appendChild(imgLeft);
    
    var imgRight=document.createElement('img');
    imgRight.setAttribute('alt',"");
    imgRight.src='{{ asset('assets/img/auth-right-img.jpg') }}';
    document.getElementById('rightImg').appendChild(imgRight);

}
</script>
@endsection
