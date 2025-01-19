@props([
   'sortDirection',
   'sortBy',
   'column'
])
<th wire:click="setSortBy('{{ $column }}')" scope="col" class="px-2 py-3 cursor-pointer">
    <div class="flex flex-row items-center gap-x-2">
                    <span>
                        {{ $slot }}
                    </span>

        @if($sortBy === $column)
            @if($sortDirection === 'asc')
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                </svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                </svg>
           @endif
        @endif
    </div>

</th>
