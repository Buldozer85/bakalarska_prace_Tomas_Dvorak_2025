@props([
    'route' => '#',
    'selected' => false
])
<li>
    <a href="{{ $route }}" class="flex items-center p-2 @if($selected) text-brand-yellow @else text-white @endif">
         {{ $ico }}
        <span class="ms-3">{{ $slot }}</span>
        @isset($rightMessage)
            {{ $rightMessage }}
        @endisset
    </a>
</li>
