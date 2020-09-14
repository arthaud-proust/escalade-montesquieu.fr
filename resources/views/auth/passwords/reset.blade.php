@extends('layouts.app', ['requirementsJs' => ['app']])

@section('title', 'Réinitialiser le mot de passe')
@section('content')
<div class="ProfilEditionLayout container d-flex flex-column align-items-center justify-content-center">
    <form class="col-md-8 d-flex flex-column align-items-strech justify-content-center" action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="ProfilEditionCard large">
            <h1 class="ProfilEditionCard-title">Réinitialiser le mot de passe</h1>
            <div class="d-flex flex-column align-items-strech justify-content-between">
                <section class="Field text @error('email') is-invalid @enderror">
                    <label class="Field-label" for="email">Adresse e-mail de votre compte</label>
                    <input class="Field-input" id="email" name="email" type="email" value="{{ old('email') ? old('email') : $email }}" autofocus required>
                    <small class="Field-info onFocus">Un mail avec le lien pour réinitialiser votre mot de passe vous sera envoyé</small>
                    @error('email')
                        <span class="Field-invalidFeedback" role="alert">{{ $message }}</span>
                    @enderror
                </section>
                <section class="Field password @error('password') is-invalid @enderror">
                    <label class="Field-label" for="password">Nouveau mot de passe</label>
                    <input class="Field-input" id="password" name="password" type="password" value="{{ old('password') ? old('password') : '' }}">
                    <img src="/assets/svg/eye-off.svg" class="Field-toggleVisibility">
                    <small class="Field-info onFocus">Conseil: Minimum 8 caractères, contenant au moins: une minuscule, une majuscule, un chiffre et un caractère spécial.</small>
                    @error('password')
                        <span class="Field-invalidFeedback" role="alert">{{ $message }}</span>
                    @enderror
                </section>
                <section class="Field password @error('password_confirm') is-invalid @enderror">
                    <label class="Field-label" for="password_confirm">Confirmation du mot de passe</label>
                    <input class="Field-input" id="password_confirm" name="password_confirm" type="password" value="{{ old('password_confirm') ? old('password_confirm') : '' }}">
                    <img src="/assets/svg/eye-off.svg" class="Field-toggleVisibility">
                    <small class="Field-info onFocus">Réécrivez le nouveau mot de passe</small>
                    @error('password_confirm')
                        <span class="Field-invalidFeedback" role="alert">{{ $message }}</span>
                    @enderror
                </section>
            </div>
            <div class="ProfilEditionLayout-actions d-flex flex-column-reverse flex-md-row align-items-strectch justify-content-center">
                <a href="{{ route('home') }}" class="btn btn-white backlink">Annuler</a>
                <button class="btn btn-success" type="submit">Réinitialiser le mot de passe</button>
            </div>
        </div>
    </div>
</div>
@endsection
