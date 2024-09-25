<li x-data="{}">
    <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
    <a @click="setCurrentLocation('{{ $hash }}')"
       x-bind:class="isCurrentLocation('{{ $hash }}') ? 'bg-gray-50 text-brand-darker' : '' "
       class=" group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold cursor-pointer">
        @isset($icon)
            <svg x-bind::class="isCurrentLocation('{{ $hash }}') ? 'text-brand-darker' : '' " class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-brand-darker " fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" aria-hidden="true">
                {{ $icon }}
            </svg>
        @endisset
        {{ $slot }}
    </a>
</li>

