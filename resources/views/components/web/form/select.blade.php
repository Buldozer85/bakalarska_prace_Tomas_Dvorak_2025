@props([
    'label',
    'id',
    'name',
    'options' => [],
    'selected' => ''
])
<div>
    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900">{{ $label }}</label>
    <select {{ $attributes->wire('model') }} id="countries" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-brand focus:border-brand block w-full p-2.5">
        @foreach($options as $key => $option)
            <option @if($selected === $key) selected @endif value="{{ $key }}">{{ $option }}</option>
        @endforeach
    </select>
</div>
