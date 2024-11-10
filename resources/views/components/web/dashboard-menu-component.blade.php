@props([
     'hash',
    'route' => '#',
])
<li x-data="{}">
    <a href="{{ $route }}"
       x-bind:class="isCurrentLocation('{{ $hash }}') ? 'bg-brand-darker text-white' : '' "
       class=" group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold cursor-pointer">
        @isset($icon)
            <svg x-bind::class="isCurrentLocation('{{ $hash }}') ? 'text-white' : 'text-gray-400 hover:text-brand-darker ' " class="h-6 w-6 shrink-0  " fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" aria-hidden="true">
                {{ $icon }}
            </svg>
        @endisset
        {{ $slot }}
    </a>
</li>

