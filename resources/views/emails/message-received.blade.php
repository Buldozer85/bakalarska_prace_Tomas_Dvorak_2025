@component('mail::message')
# Nová zpráva od {{ $heading }}

{{ $message->message }}

@component('mail::button', ['url' => $url])
Zobrazit konverzaci
@endcomponent


@endcomponent
