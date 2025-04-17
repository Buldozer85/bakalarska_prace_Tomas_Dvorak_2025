@props([
    'name',
    'id',
    'label',
    'placeholder' => '',
    'whiteText' => false
])
<div>
    <label for="{{ $id }}" class="block mb-2 text-sm font-medium @if($whiteText) !text-white @endif text-gray-900 dark:text-white">{{ $label }}</label>
    @error($name)

    <x-web.error-message>
        {{ $message }}
    </x-web.error-message>
    @enderror
    <textarea {{ $attributes }}  id="{{ $id }}" name="{{ $name }}" rows="4" class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:border-0 focus:outline-0  focus:ring-brand" placeholder="{{ $placeholder }}"></textarea>

</div>
