@props([
    'route' => null,
    'type' => '',
    'size' => '',
    'action' => null
])
@php
    $style = match ($type) {
        'black' => 'bg-brand-black text-white rounded-md py-2 px-3 shadow-sm',
        'secondary' => 'bg-white text-black px-4 py-2',
        'danger' => 'bg-red-600 text-white rounded-md py-2 px-3 text-sm font-semibold shadow-sm hover:bg-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:bg-red-400',
        'white' => 'bg-white shadow-sm rounded-md py-2 px-3 text-sm font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:bg-gray-400 hover:bg-gray-100',
        'yellow' => 'bg-brand-yellow rounded-md !text-brand-black py-2 px-3 shadow-sm',
        default =>'bg-brand text-white rounded-md py-2 px-3 text-sm font-semibold shadow-sm hover:bg-brand-darker focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:bg-brand-darker'
    };

    $size = match ($size) {
        'small' => '',
        default => ''
    };
@endphp

@if(!is_null($route))
    <a {{ $attributes->merge(['class' => 'text-sm text-decoration-none text-center font-bold cursor-pointer align-middle '. $style . ' ' . $size]) }} href="{{ $route }}">
        {{ $slot }}
    </a>
@else
    <button @if($action === 'submit') type="submit" @endif {{ $attributes->merge(['class' => 'text-sm text-decoration-none text-center font-bold text-black cursor-pointer '. $style . ' ' . $size]) }}>
        {{ $slot }}
    </button>
@endif
