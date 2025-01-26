@props([
    'currentPage' => ''
])
<header class="bg-white border-b-2 border-b-gray-100" x-data="{
    isOpenMenu: false,
    isOpenUserMenu: false
}">
    <nav class="mx-auto flex max-w-nav items-center justify-between p-6 lg:px-8 gap-x-4" aria-label="Global">
        <div class="flex xl:flex-1">
            <a href="{{ route('homepage') }}" class="-m-1.5 p-1.5">
                <img class="h-12 w-auto" src="{{ asset("images/logo.png") }}" alt="logo Kuželny Veselí">
            </a>
        </div>
        <div class="flex lg:hidden">
            <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700" @click="isOpenMenu = !isOpenMenu">
                <span class="sr-only">Otevřít hlavní menu</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
        <div class="hidden lg:flex gap-x-4 xl:flex-[2] xl:gap-x-12 items-stretch">
            <x-web.button class="leading-6 flex-1" :route="route('homepage')">Domů</x-web.button>
            <x-web.button class="leading-6 flex-1" :route="route('reservation')">Rezervace</x-web.button>
            <x-web.button class="leading-6 flex-1" :route="route('contact')">Kontakt</x-web.button>
            <x-web.button class="leading-6 flex-1" :route="route('league')">Liga</x-web.button>
        </div>
        <div class="hidden lg:flex xl:flex-1 lg:justify-end flex items-center gap-x-4 xl:gap-x-12">
            @guest
                <x-web.button type="black" class="leading-6 flex-1 max-w-[150px]" :route="route('show-login-page')">Přihlásit se</x-web.button>
                <x-web.button class="leading-6 flex-1 max-w-[150px]" display-bg type="yellow" :route="route('show-registration-page')">Zaregistrujte se!</x-web.button>
            @endguest

            @auth

                <x-web.flyout-menu name="{{ user()->full_name }}">
                    <x-slot:icon>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
                        </svg>
                    </x-slot:icon>
                    <a href="{{ route('profile') }}" class="block p-2 hover:text-brand-darker">Profil</a>
                    <a href="{{ route('profile.my-reservations') }}" class="block p-2 hover:text-brand-darker">Moje rezervace</a>
                    <a href="{{ route('profile.my-league') }}" class="block p-2 hover:text-brand-darker">Moje liga</a>
                    <a href="{{ route('profile.edit-information') }}" class="block p-2 hover:text-brand-darker">Změna údajů</a>
                    <a href="{{ route('profile.change-password.show') }}" class="block p-2 hover:text-brand-darker">Změna hesla</a>
                    <a href="{{ route('logout') }}" class="block p-2 hover:text-brand-darker">Odhlásit se</a>
                </x-web.flyout-menu>
            @endauth

        </div>
    </nav>

    <div x-show="isOpenMenu" class="lg:hidden z-40" role="dialog" aria-modal="true">
        <div class="fixed inset-0 z-40"></div>
        <div class="fixed inset-y-0 right-0 z-[80] w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
            <div class="flex items-center justify-between sm:justify-end">
                <a href="{{ route('homepage') }}" class="sm:hidden -m-1.5 p-1.5">
                    <span class="sr-only">Kužlna Veselí</span>
                    <img class="h-12 w-auto" src="{{ asset("images/logo.png") }}" alt="">
                </a>
                <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" @click="isOpenMenu = !isOpenMenu">
                    <span class="sr-only">Zavřít menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="mt-6 flow-root">
                <div class="-my-6 divide-y divide-gray-500/10">
                    <div class="space-y-2 py-6">
                        <div class="flex flex-row items-center gap-x-4 px-2 @if($currentPage === 'home') bg-brand !text-white rounded-md @endif">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <a href="{{ route('homepage') }}" class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 hover:bg-gray-50">Domů</a>
                        </div>

                        <div class="flex flex-row items-center gap-x-4 px-2 @if($currentPage === 'reservations') bg-brand !text-white rounded-md @endif">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                            </svg>
                            <a href="{{ route('reservation') }}" class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 hover:bg-gray-50">Rezervace</a>
                        </div>

                        <div class="flex flex-row items-center gap-x-4 px-2 @if($currentPage === 'contact') bg-brand !text-white rounded-md @endif">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                            </svg>

                            <a href="{{ route('contact') }}" class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 hover:bg-gray-50">Kontakt</a>
                        </div>

                        <div class="flex flex-row items-center gap-x-4 px-2 @if($currentPage === 'league') bg-brand !text-white rounded-md @endif">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>

                            <a href="{{ route('league') }}" class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 hover:bg-gray-50">Kuželkářská liga</a>
                        </div>







                    </div>

                    @auth
                        <div class="divide-gray-500/10">
                            <div class="flex flex-row items-center gap-x-4 px-2 @if($currentPage === 'profile') bg-brand !text-white rounded-md @endif">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>

                                <a href="{{ route('profile') }}" class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 hover:bg-gray-50">Profil</a>
                            </div>

                            <div class="flex flex-row items-center gap-x-4 px-2 @if($currentPage === 'my-reservations') bg-brand !text-white rounded-md @endif">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                </svg>
                                <a href="{{ route('profile.my-reservations') }}" class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 hover:bg-gray-50">Moje rezervace</a>
                            </div>

                            <div class="flex flex-row items-center gap-x-4 px-2 @if($currentPage === 'my-league') bg-brand !text-white rounded-md @endif">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 0 0 2.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 0 1 2.916.52 6.003 6.003 0 0 1-5.395 4.972m0 0a6.726 6.726 0 0 1-2.749 1.35m0 0a6.772 6.772 0 0 1-3.044 0" />
                                </svg>

                                <a href="{{ route('profile.my-league') }}" class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 hover:bg-gray-50">Moje liga</a>
                            </div>

                            <div class="flex flex-row items-center gap-x-4 px-2 @if($currentPage === 'change-credentials') bg-brand !text-white rounded-md @endif">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                                </svg>


                                <a href="{{ route('profile.edit-information') }}" class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 hover:bg-gray-50">Změna údajů</a>
                            </div>

                            <div class="flex flex-row items-center gap-x-4 px-2 @if($currentPage === 'change-password') bg-brand !text-white rounded-md @endif">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>

                                <a href="{{ route('profile.change-password.show') }}" class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 hover:bg-gray-50">Změna hesla</a>
                            </div>


                        </div>
                    @endauth
                    <div class="py-6">
                        @guest
                            <div class="flex flex-row items-center gap-x-4 px-2 @if($currentPage === 'login') bg-brand !text-white rounded-md @endif">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                                </svg>
                                <a href="{{ route('show-login-page') }}" class="-mx-3 block rounded-lg py-2.5 px-3 text-base font-semibold leading-7 hover:bg-gray-50">Přihlášení</a>
                            </div>

                            <div class="flex flex-row items-center gap-x-4 px-2 @if($currentPage === 'register') bg-brand !text-white rounded-md @endif">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                </svg>

                                <a href="{{ route('show-registration-page') }}" class="-mx-3 block rounded-lg py-2.5 px-3 text-base font-semibold leading-7 hover:bg-gray-50">Registrace</a>
                            </div>
                        @endguest
                        @auth
                                <div class="flex flex-row items-center gap-x-4 px-2 @if($currentPage === 'change-password') bg-brand !text-white rounded-md @endif">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                    </svg>


                                    <a href="{{ route('logout') }}" class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 hover:bg-gray-50">Odhlásit se</a>
                                </div>

                            @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>


</header>
