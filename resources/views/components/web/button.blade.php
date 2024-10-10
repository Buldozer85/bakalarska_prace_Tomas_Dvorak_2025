@props([
    'route' => null,
    'type' => 'primary'
])
@php
    $style = match ($type) {
        'primary' => 'bg-brand text-white rounded-md py-2 px-3 text-sm font-semibold shadow-sm hover:bg-brand-darker focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:bg-brand-darker',
        'secondary' => 'bg-white text-black rounded-xl px-4 py-2',
        'danger' => 'bg-red-600 text-white rounded-md py-2 px-3 text-sm font-semibold shadow-sm hover:bg-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:bg-red-400',
        'white' => 'bg-white border-2 border-gray-300 shadow-sm rounded-md py-2 px-3 text-sm font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:bg-gray-400 hover:bg-gray-100',
        default => ''
    }
@endphp

@if(!is_null($route))
    <a {{ $attributes->merge(['class' => 'text-decoration-none font-bold text-black cursor-pointer'. $style]) }} href="{{ $route }}">
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => 'text-decoration-none font-bold text-black cursor-pointer '. $style]) }}>
        {{ $slot }}
    </button>
@endif
