@props([
    'name',
    'color' => 'bg-brand text-white'
])
<p class="size-12 flex-none rounded-full {{ $color }} flex items-center justify-center"> {{ makeInitials($name) }}</p>
