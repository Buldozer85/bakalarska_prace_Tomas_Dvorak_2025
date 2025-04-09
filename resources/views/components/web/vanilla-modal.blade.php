@props([
    'id'
])
<div x-cloak x-show="{{ $id }}" id="{{ $id }}" tabindex="-1" class=" overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full flex bg-gray-900/80">
    <div class="relative w-full max-w-md max-h-full">
        <div class="relative rounded-lg shadow bg-brand-black text-white">
            <button @click="{{ $id }} = false" type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Zavřít vyskakovací okno</span>
            </button>
            <div class="p-4 md:p-8 text-center space-y-8">
                <div class="flex flex-col justify-center items-center gap-y-6">
                  {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
