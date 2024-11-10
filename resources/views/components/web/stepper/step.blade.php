@props(
    [
        'number',
        'done' => false,
        'label' => '',
        'selected' => false
    ]
)

@php
    $style = ($selected) ? 'font-bold text-brand-darker' : 'font-normal text-brand-black';
    $border = ($selected) ? 'border-2 border-brand-darker' : 'border border-brand-black'
@endphp
<div {{ $attributes->merge(['class' => 'flex flex-row items-center gap-x-4 cursor-pointer justify-center']) }}>
    <span class="{{ $border }} rounded-full w-12 h-12 flex items-center justify-center">
        @if(!$done)
            <p class="{{ $style }}">
             {{ $number }}
            </p>


        @else
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-8 w-8 {{ $style }}">
                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
            </svg>
        @endif
    </span>

    <p class="{{ $style }}">
        {{ $label }}
    </p>

</div>
