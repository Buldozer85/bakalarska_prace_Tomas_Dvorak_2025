<div class="relative">
    <button type="button" class="inline-flex items-center gap-x-1 text-sm font-semibold leading-6 text-gray-900 bg-brand bg-brand text-white rounded-md py-2 px-3 text-sm font-semibold shadow-sm hover:bg-brand-darker focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:bg-brand-darker" @click="isOpenUserMenu = !isOpenUserMenu" aria-expanded="false">
        @isset($icon)
            {{ $icon }}
        @endisset

        <span>{{ $name }}</span>
        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
        </svg>
    </button>

    <div class="absolute left-1/2  mt-5 flex w-screen max-w-min -translate-x-1/2 px-4 z-50" x-show="isOpenUserMenu">
        <div class="w-56 shrink rounded-xl bg-white p-4 text-sm font-semibold leading-6 text-gray-900 shadow-lg ring-1 ring-gray-900/5">
            {{ $slot }}
        </div>
    </div>
</div>
