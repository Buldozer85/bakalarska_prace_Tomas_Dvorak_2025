@props([
    'status'
])

@php
    $statusColor = match ($status['key']) {
        'cancelled' => 'cancelled',
        'confirmed' => 'success',
        default => 'waiting'
    }
@endphp
<div>
    <x-web.badge :type="$statusColor">
      {{ $status['label'] }}
    </x-web.badge>
</div>
