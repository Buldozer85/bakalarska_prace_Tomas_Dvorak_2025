@props([
    'id',
    'name',
    'type' => 'text',
    'label' => '',
    'autoComplete' => false,
    'required' => false,
    'value' => '',
    'whiteText' => false
])
<div>
    @if(!empty($label))
        <label for="{{ $id }}" class="text-left block text-sm font-medium leading-6 text-gray-900 @if($whiteText) !text-white @endif">{{ $label }}</label>
    @endif
    @error($name)
        <x-web.error-message>
            {{ $message }}
        </x-web.error-message>
    @enderror
    <div class=" @if(!empty($label)) mt-2  @endif">
        <input id="{{ $id }}"
               name="{{ $name }}"
               type="{{ $type }}"
               autocomplete="{{ $autoComplete }}"
               value="{{ $value }}"
               @if($required) required @endif
            {{ $attributes }}

               class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand sm:text-sm sm:leading-6">
    </div>
</div>
