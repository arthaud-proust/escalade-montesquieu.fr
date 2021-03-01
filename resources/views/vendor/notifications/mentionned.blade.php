@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Hello!')
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
Bonne journée,<br>
{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@slot('subcopy')
@isset($actionText)
@lang(
    "Si vous avez des problèmes pour cliquer sur le bouton \":actionText\" , copiez et collez l'URL ci-dessous\n".
    'dans votre navigateur:',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
@endisset
<br><span class="break-all">Pour désactiver les notifications par mail [modifiez votre profil](https://escalade-montesquieu.fr/profil/edit)</span>
@endslot
@endcomponent
