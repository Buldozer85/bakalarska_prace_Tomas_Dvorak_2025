@props([
    'id',
    'name',
    'fromEmail',
    'messageCount' => 0
])


<li class="flex justify-between gap-x-6 py-5 items-center">
        <div class="flex min-w-0 gap-x-4">
            <x-admin.message-bubble name="{{ $name }}"/>
            <div class="min-w-0 flex-auto">
                <p class="text-sm/6 font-semibold text-gray-900">{{ $name }}</p>
                <p class="mt-1 truncate text-xs/5 text-gray-500">{{ $fromEmail }}</p>
            </div>
        </div>
        <div class="hidden shrink-0 sm:flex sm:flex-row sm:items-center gap-x-4">
            <p class="text-md text-gray-500">{{ $messageCount }}</p>
            <p class="text-sm/6 text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" />
                    <path d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" />
                </svg>
            </p>

            <x-admin.button :route="route('administration.conversations.detail', $id)">Zobrazit</x-admin.button>
        </div>
    <x-admin.button class="sm:hidden" :route="route('administration.conversations.detail', $id)">Zobrazit</x-admin.button>
</li>

