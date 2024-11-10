@props([
    'name',
    'id',
    'required' => false,
    'color' => 'primary'
])

@php
    $style = match ($color) {
        'yellow' => 'border-brand-black text-yellow-300 focus:ring-brand-black' ,
        default => 'border-gray-300 text-brand focus:ring-brand'
    }
@endphp

<div class="flex flex-col">

    <div class="relative flex items-start">
        <div class="flex h-6 items-center">
            <input id="{{ $id }}" name="{{ $name }}" type="checkbox" {{ $attributes }}
                   class="h-4 w-4 rounded {{ $style }}" @if($required) required @endif>
        </div>
        @if(!is_null($slot))
            <div class="ml-3 text-sm leading-6">
                <label for="{{ $id }}" class="font-medium text-gray-900">{{ $slot }}</label>
            </div>
        @endif
    </div>
    @error($name)
    <x-web.error-message>
        {{ $message }}
    </x-web.error-message>
    @enderror
</div>

