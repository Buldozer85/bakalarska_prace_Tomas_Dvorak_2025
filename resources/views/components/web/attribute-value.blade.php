@props([
    'label' => ''
])
<p {{ $attributes->merge(['class' => 'space-x-4']) }}><span class="font-bold pr-2 text-brand-black">{{ $label }}:</span>{{ $slot }}</p>
