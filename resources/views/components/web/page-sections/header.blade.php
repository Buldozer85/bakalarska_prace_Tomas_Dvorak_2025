
<header class="bg-white border-b-2 border-b-gray-100" x-data="{
    isOpenMenu: false,
    isOpenUserMenu: false
}">
    <nav class="mx-auto flex max-w-nav items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="flex lg:flex-1">
            <a href="#" class="-m-1.5 p-1.5">
                <img class="h-12 w-auto" src="{{ asset("images/logo.png") }}">
            </a>
        </div>
        <div class="flex lg:hidden">
            <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700" @click="isOpenMenu = !isOpenMenu">
                <span class="sr-only">Open main menu</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
        <div class="hidden lg:flex lg:gap-x-12">
            <x-web.button class="leading-6" :route="route('homepage')">Domů</x-web.button>
            <x-web.button class="leading-6" :route="route('homepage')">Rezervace</x-web.button>
            <x-web.button class="leading-6" :route="route('contact')">Kontakt</x-web.button>
            <x-web.button class="leading-6" :route="route('contact')">Kuželkářská liga</x-web.button>
        </div>
        <div class="hidden lg:flex lg:flex-1 lg:justify-end flex items-center lg:gap-x-12">
            @guest
                <x-web.button class="leading-6" :route="route('show-login-page')">Přihlášení</x-web.button>
                <x-web.button class="leading-6" display-bg type="primary" :route="route('show-registration-page')">Registrace</x-web.button>
            @endguest

            @auth

                <x-web.flyout-menu name="{{ user()->full_name }}">
                    <x-slot:icon>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
                        </svg>
                    </x-slot:icon>
                    <a href="{{ route('profile') }}" class="block p-2 hover:text-brand-darker">Profil</a>
                    <a href="{{ route('profile') }}" class="block p-2 hover:text-brand-darker">Moje rezervace</a>
                    <a href="{{ route('profile') }}" class="block p-2 hover:text-brand-darker">Moje liga</a>
                    <a href="{{ route('profile') }}" class="block p-2 hover:text-brand-darker">Změna rezervace</a>
                    <a href="{{ route('profile') }}" class="block p-2 hover:text-brand-darker">Změna hesla</a>
                    <a href="{{ route('logout') }}" class="block p-2 hover:text-brand-darker">Odhlásit se</a>
                </x-web.flyout-menu>
            @endauth

        </div>
    </nav>
    <!-- Mobile menu, show/hide based on menu open state. -->
    <div x-show="isOpenMenu" class="lg:hidden z-40" role="dialog" aria-modal="true">
        <!-- Background backdrop, show/hide based on slide-over state. -->
        <div class="fixed inset-0 z-40"></div>
        <div class="fixed inset-y-0 right-0 z-40 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
            <div class="flex items-center justify-between sm:justify-end">
                <a href="#" class="sm:hidden -m-1.5 p-1.5">
                    <span class="sr-only">Your Company</span>
                    <img class="h-12 w-auto" src="{{ asset("images/logo.png") }}" alt="">
                </a>
                <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" @click="isOpenMenu = !isOpenMenu">
                    <span class="sr-only">Close menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="mt-6 flow-root">
                <div class="-my-6 divide-y divide-gray-500/10">
                    <div class="space-y-2 py-6">
                        <a href="{{ route('homepage') }}" class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Domů</a>

                        <a href="#" class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Rezervace</a>

                        <a href="{{ route('contact') }}" class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Kontakt</a>
                        <a href="{{ route('contact') }}" class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Kuželkářská liga</a>

                    </div>
                    <div class="py-6">
                        <a href="#" class="-mx-3 block rounded-lg py-2.5 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Přihlášení</a>
                        <a href="#" class="-mx-3 block rounded-lg py-2.5 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Registrace</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
