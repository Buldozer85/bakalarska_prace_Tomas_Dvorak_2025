@props([
    'type' => 'confirmed'
])

@php
    $color = match($type) {
        'cancelled' => 'bg-red-400 text-white',
        'waiting' => 'bg-brand-yellow text-black',
        default => 'bg-brand text-white'
    };
@endphp
<span class="{{ $color }} text-xs font-medium me-2 px-2.5 py-0.5 rounded w-[135px] block text-center">{{ $slot }}</span>
