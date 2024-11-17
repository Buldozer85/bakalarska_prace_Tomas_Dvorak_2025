@props([
    'id',
    'name',
    'options' => [],
    'label' => '',
    'selected' => ''
])
<div>
    @if(!empty($label))
        <label for="{{ $id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $label }}</label>
    @endif

    <select {{ $attributes }} id="{{ $id }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand sm:text-sm sm:leading-6">
        @foreach($options as $key => $option)
            <option @if($selected === $key) selected @endif value="{{ $key }}">{{ $option }}</option>
        @endforeach
    </select>
</div>
