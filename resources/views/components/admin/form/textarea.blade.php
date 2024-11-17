@props([
    'name',
    'id',
    'label' => ''
])
<div>
    <label for="{{ $id }}" class="block mb-2 text-sm font-medium text-gray-900">{{ $label }}</label>
    <textarea {{ $attributes }} id="{{ $id }}" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:border-0 focus:outline-0 focus:ring-2 focus:ring-inset focus:ring-brand" placeholder="Zde napiště poznámku...">{{ $slot }}</textarea>
</div>
