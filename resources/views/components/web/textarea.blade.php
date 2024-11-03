@props([
    'name',
    'id',
    'label',
    'placeholder' => '',
    'whiteText' => false
])
<div>
    <label for="{{ $id }}" class="block mb-2 text-sm font-medium @if($whiteText) !text-white @endif text-gray-900 dark:text-white">{{ $label }}</label>
    <textarea id="{{ $id }}" name="{{ $name }}" rows="4" class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300" placeholder="{{ $placeholder }}"></textarea>

</div>
