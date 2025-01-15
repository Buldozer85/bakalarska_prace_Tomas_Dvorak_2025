@props([
    'label',
    'id',
    'name',
    'options' => [],
    'selected' => ''
])
<div>
    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $label }}</label>
    <select {{ $attributes->wire('model') }} id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        @foreach($options as $key => $option)
            <option @if($selected === $key) selected @endif value="{{ $key }}">{{ $option }}</option>
        @endforeach
    </select>
</div>
