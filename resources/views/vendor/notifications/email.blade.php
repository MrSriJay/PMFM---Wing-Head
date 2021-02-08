@component('mail::message')

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
@lang('Regards'),<br>
    <b>Performance Monitoring & Fault Management System</b> <br>
    <small style="margin-top:-10px">Center for Defence Research & Development, Ministry for National Security</small>
    <br>
    <small style="margin-top:-10px"><i>Mahenawaththa,Moragahahena Road, Pitipana, Homagama</i></small>
    <br>
    <small style="margin-top:-10px"><i>Tel : 011-3173491 / 077-3929482</i></small>
    <br>
    <small style="margin-top:-10px"><i>Fax : 011-2182175</i></small>
    <br>
    <small style="margin-top:-10px"><i>Email : hq@crd.lk / hqcrdmod@gmail.com</i></small>
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
    "If you’re having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
    'into your web browser:',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
@endslot
@endisset
@endcomponent
