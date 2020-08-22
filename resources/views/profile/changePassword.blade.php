@extends('layouts.app')

@section('title', 'Éditer mon profil')
@section('content')
<div class="ProfilEditionLayout container d-flex flex-column align-items-center justify-content-center">
    <form class="col-8 d-flex flex-column align-items-strech justify-content-center" action="{{ route('updatePassword') }}" method="POST">
        @csrf
        <div class="ProfilEditionCard large">
            <h1 class="ProfilEditionCard-title">Changer de mot de passe</h1>
            <div class="d-flex flex-column align-items-strech justify-content-between">
                <section class="Field password @error('password') is-invalid @enderror">
                    <label class="Field-label" for="password">Ancien mot de passe</label>
                    <input class="Field-input" id="password" name="password" type="password" value="{{ old('password') ? old('password') : '' }}">
                    <img src="/assets/svg/eye-off.svg" class="Field-toggleVisibility">
                    <small class="Field-info">Pour éviter une mauvaise manipulation</small>
                    @error('password')
                        <span class="Field-invalidFeedback" role="alert">{{ $message }}</span>
                    @enderror
                </section>
                <section class="Field password @error('new_password') is-invalid @enderror">
                    <label class="Field-label" for="new_password">Nouveau mot de passe</label>
                    <input class="Field-input" id="new_password" name="new_password" type="password" value="{{ old('new_password') ? old('new_password') : '' }}">
                    <img src="/assets/svg/eye-off.svg" class="Field-toggleVisibility">
                    <small class="Field-info">Minimum 8 caractères. Conseil: contenant au moins une minuscule, une majuscule, un chiffre et un caractère spécial.</small>
                    @error('new_password')
                        <span class="Field-invalidFeedback" role="alert">{{ $message }}</span>
                    @enderror
                </section>
                <section class="Field password @error('new_password_confirmation') is-invalid @enderror">
                    <label class="Field-label" for="new_password_confirmation">Confirmation du mot de passe</label>
                    <input class="Field-input" id="new_password_confirmation" name="new_password_confirmation" type="password" value="{{ old('new_password_confirmation') ? old('new_password_confirmation') : '' }}">
                    <img src="/assets/svg/eye-off.svg" class="Field-toggleVisibility">
                    <small class="Field-info">Réécrivez le nouveau mot de passe</small>
                    @error('new_password_confirmation')
                        <span class="Field-invalidFeedback" role="alert">{{ $message }}</span>
                    @enderror
                </section>
            </div>
        </div>

        <div class="ProfilEditionLayout-actions d-flex flex-row align-items-center justify-content-center">
            <a href="{{ route('showProfile') }}" class="btn btn-white backlink">Annuler</a>
            <button class="btn btn-success" type="submit">Modifier le mot de passe</button>
        </div>
    </form>
</div>
<script src="{{ asset('js/user.js') }}" defer></script>

@endsection