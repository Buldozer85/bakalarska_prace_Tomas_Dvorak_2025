@props([
    'name',
    'color' => null
])
@php
    if(is_null($color)) {
        $colorArray = ['bg-brand text-white', 'bg-brand-yellow', 'bg-brand-brown-red text-white', 'bg-brand-black text-white', 'bg-brand-reserved text-white'];
        $color = $colorArray[array_rand($colorArray)];
    }

@endphp
<p class="size-12 flex-none rounded-full {{ $color }} flex items-center justify-center"> {{ makeInitials($name) }}</p>
