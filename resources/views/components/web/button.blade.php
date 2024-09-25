@props([
    'route' => null,
    'type' => 'primary'
])
@php
    $style = match ($type) {
        "primary" => "bg-brand text-white rounded-md py-2 px-3 text-sm font-semibold shadow-sm hover:bg-brand-darker focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:bg-brand-darker",
        "secondary" => "bg-white text-black rounded-xl px-4 py-2",
        default => ""
    }
@endphp

@if(!is_null($route))
    <a {{ $attributes->merge(['class' => 'text-decoration-none font-bold text-black '. $style]) }} href="{{ $route }}">
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => 'text-decoration-none font-bold text-black '. $style]) }}>
        {{ $slot }}
    </button>
@endif
