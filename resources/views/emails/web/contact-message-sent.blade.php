@component('mail::message')
# Shrnutí Vašeho dotazu ze dne {{ $message->sent->format('j.n.Y') }}

## Obsah zprávy:
{{ $message->message }}
<br>

Děkujeme za Váš dotaz. V blízké době Vás budeme kontaktovat<br>
S pozdravem,<br>
tým Kuželny Veselí
@endcomponent
