@props([
    'number',
    'date',
    'id',
    'year',
    'selected' => false
])
<div class="w-24 h-24 flex flex-col shadow-xl items-center  p-1 py-1 cursor-pointer rounded-md @if($selected) text-white bg-brand @else bg-white text-brand-black @endif" {{ $attributes }}>
    <p class="text-lg font-bold">{{ $number }}.</p>
    <p class="text-md font-bold">kolo</p>
    <p class="text-[10px] font-normal">{{ $date }}</p>
    <p class="text-[10px] font-normal">{{ $year }}</p>
</div>
