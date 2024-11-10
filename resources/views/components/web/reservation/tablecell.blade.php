@props([
    'id',
    'type' => 'empty',
    'readOnly' => false
])

@php
    $style = match ($type) {
        'unavailable' => 'bg-gray-300',
        'reserved' => 'bg-brand-reserved',
        default => 'bg-white'
    }
@endphp

<td  @if($type !== 'empty') data-tooltip-target="{{ $id }}"  @endif class="px-6 py-4 border overflow-hidden {{ $style }} @if(!$readOnly) cursor-pointer @endif">
{{ $slot }}
    @if($type !== 'empty')
        <div id="{{$id}}" role="tooltip" class="  absolute z-40 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            @switch($type)
                @case('unavailable')
                    Nedostupné
                    @break

                @case('reserved')
                    Rezervováno
                    @break

                @default
                    @break
            @endswitch
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    @endif

</td>


