@props([
    'id',
    'text',
    'confirmAction' => ''
])
<x-web.modal id="{{ $id }}">
    <svg class="mx-auto mb-4 text-black w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
    </svg>
    <h3 class="mb-5 text-lg font-bold text-black">{{ $text }}</h3>
    <div class="flex justify-between max-w-[250px] gap-x-5 mx-auto">
        <x-web.button class="flex-1" @click="{{ $confirmAction }}" data-modal-hide="{{ $id }}" type="danger">Potvrdit</x-web.button>
        <x-web.button class="flex-1" data-modal-hide="{{ $id }}" data-modal-hide="{{ $id }}" type="white">Zrušit</x-web.button>
    </div>


</x-web.modal>
