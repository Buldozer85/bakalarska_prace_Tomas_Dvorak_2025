@props([
    'site' => 'profil'
])

<div class="flex w-full max-w-nav mx-auto" x-data="{
    currentUrl: '{{ $site }}',

    isCurrentLocation(location) {
        return this.currentUrl === location
    },
}">
    <div class="hidden h-full min-h-screen lg:inset-y-0 lg:z-40 lg:flex lg:w-72 lg:flex-col">
        <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6">
            <nav class="flex flex-1 flex-col pt-32">
                <ul role="list" class="flex flex-1 flex-col gap-y-7">
                    <li>
                        <ul role="list" class="-mx-2 space-y-8">
                            <x-web.dashboard-menu-component :route="route('profile')" hash="profil">
                                <x-slot:icon>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </x-slot:icon>
                                Profil
                            </x-web.dashboard-menu-component>

                            <x-web.dashboard-menu-component :route="route('profile.edit-information')" hash="zmena-osobnich-udaju">
                                <x-slot:icon>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                                </x-slot:icon>
                                Změna osobních údajů
                            </x-web.dashboard-menu-component>

                            <x-web.dashboard-menu-component hash="zmena-hesla" :route="route('profile.change-password.show')">
                                <x-slot:icon>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </x-slot:icon>
                                Změna hesla
                            </x-web.dashboard-menu-component>

                            <x-web.dashboard-menu-component :route="route('profile.my-reservations')" hash="moje-rezervace">
                                <x-slot:icon>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </x-slot:icon>
                                Moje rezervace
                            </x-web.dashboard-menu-component>

                            @can('view-any', \App\Models\League::class)
                            <x-web.dashboard-menu-component hash="moje-liga" :route="route('profile.my-league')">
                                <x-slot:icon>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                </x-slot:icon>
                                Moje liga
                            </x-web.dashboard-menu-component>
                            @endcan
                            <x-web.dashboard-menu-component hash="konverzace" :route="route('profile.conversations')">
                                <x-slot:icon>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                </x-slot:icon>
                                Zprávy
                            </x-web.dashboard-menu-component>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="xl:p-12 mt-12 w-full">
        <div class="px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </div>
</div>
