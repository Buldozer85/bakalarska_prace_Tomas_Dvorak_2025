@props([
    'id',
    'model',
   'action' => ''
])
<x-admin.modal id="{{ $id }}">
    <div class="flex flex-col justify-center items-center gap-y-6">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-14 text-brand-reserved">
            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
        </svg>

        <h3 class="text-xl font-bold">Smazat záznam</h3>

        <p class="font-normal">{{ $slot }}</p>

        <div class="flex flex-row gap-x-4 w-full">
            <form action="{{ $action }}" class="flex-1 w-full" method="POST">
                @csrf
                @method('DELETE')
                <x-admin.button class="w-full" action="submit" type="danger">Smazat</x-admin.button>
            </form>

            <x-admin.button class="flex-1" data-modal-hide="{{ $id }}" type="yellow">Zrušit</x-admin.button>
        </div>
    </div>
</x-admin.modal>
