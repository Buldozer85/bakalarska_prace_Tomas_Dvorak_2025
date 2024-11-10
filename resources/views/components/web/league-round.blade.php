@props([
    'number',
    'date',
    'id',
    'selected' => false
])
<div class="w-20 h-20 flex flex-col shadow-xl items-center  p-1 py-1 cursor-pointer rounded-md @if($selected) text-white bg-brand @else bg-white text-brand-black @endif">
    <p class="text-xl font-bold">{{ $number }}.</p>
    <p class="text-lg font-bold">kolo</p>
    <p class="text-[10px] font-normal">{{ $date }}</p>
</div>
