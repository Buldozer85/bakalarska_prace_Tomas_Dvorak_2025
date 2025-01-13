@props([
    'image' => '',
    'alt' => '',
    'sr' => ''
])
<div
    class="group aspect-w-10 aspect-h-7 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-brand focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
    <img src="{{ $image }}" alt="{{ $alt }}"
         class="pointer-events-none object-cover group-hover:opacity-75">
    <button type="button" class="absolute inset-0 focus:outline-none">
        <span class="sr-only">{{ $sr }}</span>
    </button>
</div>
