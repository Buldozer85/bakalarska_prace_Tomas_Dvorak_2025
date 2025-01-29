@props([
    'color' => ''
])

@php
    $style = match ($color) {
        'black' => 'bg-brand-black text-white',
        default => 'bg-brand text-white'
    };
@endphp

<div {{ $attributes->merge(["class" => $style . " text-center py-10 space-y-8 rounded-md px-4 2xl:px-16 lg:w-[350px] 2xl:w-[450px] mx-6 lg:mx-auto"]) }}>
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
