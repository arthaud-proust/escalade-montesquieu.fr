@if(session('status'))
<div class="alert alert-{{session('status')}} alert-dismissible fade show my-3" role="alert">
    {{ session('content') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if(session('alert-status') && \Request::route()->getName() !='editProfil')
<div class="alert alert-{{session('alert-status')}} alert-dismissible fade show my-3" role="alert">
    {{ session('alert-content') }}
    <a href="{{ session('alert-link-href') }}">{{ session('alert-link-title') }}</a>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif