@extends('layouts.app', ['requirementsJs' => ['app']])

@section('title', 'Mot de passe perdu')
@section('content')
<div class="ProfilEditionLayout container d-flex flex-column align-items-center justify-content-center">
    <form class="col-md-8 d-flex flex-column align-items-strech justify-content-center" action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="ProfilEditionCard large">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <h1 class="ProfilEditionCard-title">Mot de passe perdu</h1>
            <div class="d-flex flex-column align-items-strech justify-content-between">
                <section class="Field text @error('email') is-invalid @enderror">
                    <label class="Field-label" for="email">Adresse e-mail de votre compte</label>
                    <input class="Field-input" id="email" name="email" type="email" value="{{ old('email') ? old('email') : '' }}" autofocus required>
                    <small class="Field-info">Un mail avec le lien pour réinitialiser votre mot de passe vous sera envoyé</small>
                    @error('email')
                        <span class="Field-invalidFeedback" role="alert">{{ $message }}</span>
                    @enderror
                </section>
            </div>
        </div>

        <div class="ProfilEditionLayout-actions d-flex flex-column-reverse flex-md-row align-items-strectch justify-content-center">
            <a href="{{ route('login') }}" class="btn btn-white backlink">Annuler</a>
            <button class="btn btn-success" type="submit">Envoyer le lien</button>
        </div>
    </form>
</div>
@endsection
