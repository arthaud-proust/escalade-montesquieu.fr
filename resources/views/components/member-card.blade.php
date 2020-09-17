<div class="MemberCard">
    <div class="MemberCard-header">
        <h3 class="MemberCard-name">{{$member->name}}</h3>
    </div>
    <div class="MemberCard-actions">
        @if($member->name !== Auth::User()->name)
        <button class="MemberCard-delete">Supprimer</button>
        @endif
    </div>
</div>