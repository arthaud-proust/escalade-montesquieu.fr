<div class="UserCard level-{{$user->level}}" data-uuid="{{$user->uuid}}" data-name="{{$user->name}}">
    <div class="UserCard-header">
        <img class="UserCard-img" src="{{$user->img}}" alt="">
        <div>
            <a href="{{ route('userProfile', $user->uuid) }}">
                <h3 class="UserCard-name">{{$user->name}}</h3>
            </a>
            <span class="UserCard-level level-{{$user->level}}">{{$user->level==1?'Grimpeur':($user->level==2?'Modo':($user->level==3?'Admin':$user->level))}}</span>
        </div>
    </div>
    <div class="UserCard-info">
        <span class="UserCard-email">{{$user->email}}</span>
    </div>
    <div class="UserCard-actions">
        @if($user->uuid == Auth::user()->uuid)
        <span>Vous ne pouvez pas modifier cet utilisateur</span>
        @else
        <span>
            Niveau:
            <select class="UserCard-changeLevel">
                <option value="1" @if($user->level==1) selected @endif>Grimpeur</option>
                <option value="2" @if($user->level==2) selected @endif>Modo</option>
                <option value="3" @if($user->level==3) selected @endif>Admin</option>
            </select>
        </span>
        <button class="UserCard-delete">Supprimer ce compte</button>
        @endif
    </div>
</div>