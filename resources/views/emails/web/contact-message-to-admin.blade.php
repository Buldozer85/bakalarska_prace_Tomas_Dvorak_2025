@component('mail::message')
# Dotaz od: {{ $conversation->from_name }} {{ $conversation->from_email }}

## Obsah dotazu:

{{ $message->message }}

@endcomponent
