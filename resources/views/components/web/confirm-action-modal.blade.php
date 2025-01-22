@props([
    'id',
    'text',
    'confirmAction' => ''
])
<x-web.modal id="{{ $id }}">
{{ $slot }}

</x-web.modal>
