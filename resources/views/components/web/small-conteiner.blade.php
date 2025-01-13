@props([
    'color' => ''
])

@php
    $style = match ($color) {
        'black' => 'bg-brand-black text-white',
        default => 'bg-brand text-white'
    };
@endphp

<div {{ $attributes->merge(["class" => $style . " text-center py-10 space-y-8 rounded-md px-16 2xl:w-[650px] mx-6 2xl:mx-auto"]) }}>
    @isset($icon)
        {{ $icon }}
    @endisset

    <div class="text-center space-y-4">
        {{ $slot }}
    </div>

    @isset($button)
        {{ $button }}
    @endisset
</div>
