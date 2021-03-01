@extends('layouts.app', ['requirementsJs' => ['app', 'user']])

@section('title', 'Éditer mon profil')
@section('content')
<div class="my-5 ProfilEditionLayout container d-flex flex-column align-items-center justify-content-center">
    <canvas id="canvas" style="display:none;"></canvas>
    <form class="p-0 col-md-10 d-flex flex-column align-items-strech justify-content-center" action="{{ route('updateProfile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')    
        <div class="ProfilEditionCard large">
            <h1 class="ProfilEditionCard-title">Édition du profil</h1>
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <section class="Field img @error('img') is-invalid @enderror">
                    <label for="img" class="Field-label"><img id="preview" src="{{ route('imgProfile', $user->uuid) }}"></label>
                    <input id="img" name="img" class="Field-input" type="file">
                    @error('img')
                        <span class="Field-invalidFeedback" role="alert">{{ $message }}</span>
                    @enderror
                </section>
                <section class="Field text disabled @error('name') is-invalid @enderror">
                    <label class="Field-label" for="name">Nom</label>
                    <input class="Field-input" id="name" name="name" type="text" value="{{ old('name') ? old('name') : $user->name }}">
                    <small class="Field-info">Information publique</small>
                    @error('name')
                        <span class="Field-invalidFeedback" role="alert">{{ $message }}</span>
                    @enderror
                </section>
                <section class="Field text @error('email') is-invalid @enderror">
                    <label class="Field-label" for="email">Email</label>
                    <input class="Field-input" id="email" name="email" type="text" value="{{ old('email') ? old('email') : $user->email }}">
                    <small class="Field-info">Information privée</small>
                    @error('email')
                        <span class="Field-invalidFeedback" role="alert">{{ $message }}</span>
                    @enderror
                </section>
            </div>

            <section class="Field textarea pt-4 pt-md-0 @error('bio') is-invalid @enderror">
                <label class="Field-label large" for="bio">Bio</label>
                <textarea class="Field-input" id="bio" name="bio">{{ old('bio') ? old('bio') : $user->bio }}</textarea>
                <small class="Field-info">Information publique</small>
                @error('bio')
                    <span class="Field-invalidFeedback" role="alert">{{ $message }}</span>
                @enderror
            </section>
        </div>

        <div class="d-flex flex-column flex-md-row align-items-strech justify-content-between">

            <div class="ProfilEditionCard">
                <h1 class="ProfilEditionCard-title little">Cotation max</h1>
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <section class="Field select @error('max_voie') is-invalid @enderror">
                        <label class="Field-label" for="max_voie">En voie</label>
                        <select class="Field-input" id="max_voie" name="max_voie" data-value="{{ old('max_voie') ? old('max_voie') : $user->max_voie }}">
                            <!-- js     -->
                        </select>
                        @error('max_voie')
                            <span class="Field-invalidFeedback" role="alert">{{ $message }}</span>
                        @enderror
                    </section>
                    <section class="Field select @error('max_bloc') is-invalid @enderror">
                        <label class="Field-label" for="max_bloc">En bloc</label>
                        <select class="Field-input" id="max_bloc" name="max_bloc" data-value="{{ old('max_bloc') ? old('max_bloc') : $user->max_bloc }}">
                            <!-- js     -->
                        </select>
                        @error('max_bloc')
                            <span class="Field-invalidFeedback" role="alert">{{ $message }}</span>
                        @enderror
                    </section>
                </div>
                <section class="Field checkbox @error('display_max') is-invalid @enderror">
                    <span class="Field-title">Confidentialité</span>
                    <label class="Field-label" for="display_max">
                        <input class="Field-checkbox" id="display_max" name="display_max" type="checkbox" @if(!$user->display_max) checked @endif>
                        Cette information est privée
                    </label>
                    @error('display_max')
                        <span class="Field-invalidFeedback" role="alert">{{ $message }}</span>
                    @enderror
                </section>
            </div>

            <div class="ProfilEditionCard">
                <h1 class="ProfilEditionCard-title little">Équipement</h1>
                <p class="ProfilEditionCard-desc">Quel matériel faut-il vous réserver à chaque inscription à un évènement? Cette information est publique.</p>
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <section class="Field select @error('shoes') is-invalid @enderror">
                        <label class="Field-label" for="shoes">Chaussures à emprunter</label>
                        <select class="Field-input" id="shoes" name="shoes" data-value="{{ old('shoes') ? old('shoes') : $user->shoes }}">
                            <!-- js     -->
                        </select>
                        @error('shoes')
                            <span class="Field-invalidFeedback" role="alert">{{ $message }}</span>
                        @enderror
                    </section>
                    <section class="Field checkbox @error('harness') is-invalid @enderror">
                        <span class="Field-title">Baudrier</span>
                        <label class="Field-label" for="harness">
                            <input class="Field-checkbox" id="harness" name="harness" type="checkbox" @if($user->harness) checked @endif>
                            J'emprunte un baudrier
                        </label>
                        @error('harness')
                            <span class="Field-invalidFeedback" role="alert">{{ $message }}</span>
                        @enderror
                    </section>
                </div>
            </div>

            
        
        </div>

        <div class="ProfilEditionCard">
                <h1 class="ProfilEditionCard-title little">Notifications email</h1>
                <p class="ProfilEditionCard-desc">Dans quel cas faut-il vous envoyer un email?</p>
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                    @foreach($user->emailRules as $prefLetter => $prefDetails)
                        <section class="Field checkbox @error('email_preferences['.$prefLetter.']') is-invalid @enderror">
                            <span class="Field-title">{{ $prefDetails['title'] }}</span>
                            <label class="Field-label" for="email_preferences[{{ $prefLetter }}]">
                                <input class="Field-checkbox" id="email_preferences[{{ $prefLetter }}]" name="email_preferences[{{ $prefLetter }}]" type="checkbox" @if($user->isMailableFor($prefLetter)) checked @endif>
                                {{ $prefDetails['desc'] }}
                            </label>
                            @error('email_preferences['.$prefLetter.']')
                                <span class="Field-invalidFeedback" role="alert">{{ $message }}</span>
                            @enderror
                        </section>
                    @endforeach
                </div>
            </div>

        <div class="ProfilEditionLayout-actions d-flex flex-column-reverse flex-md-row align-items-stretch justify-content-center">
            <a href="{{ route('showProfile') }}" class="btn btn-white backlink">Annuler</a>
            <button class="btn btn-success" type="submit">Enregistrer les modifications</button>
        </div>
    </form>
</div>
<script src="{{ asset('js/user.js') }}" defer></script>

@endsection