<x-web.layouts.app page="my-league" title="{{ $league->name }}">
    <x-web.layouts.dashboard site="moje-liga">
        <div class="max-w-[200px] max-md:mx-auto">
            <x-web.button class="flex flex-row items-center gap-x-12" :route="route('profile.my-league')" type="yellow">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                </svg>

                Zpět
            </x-web.button>
        </div>

        <div class="flex justify-center md:justify-between items-center">
            <h1 class="text-xl text-black font-bold border-b-4 border-brand-darker text-center mt-12 max-md:mx-4 max-w-[300px] pb-2">{{ $league->name }}</h1>
        </div>

        <div class=" max-w-7xl space-y-16 flex flex-col md:flex-row justify-center md:justify-between mt-12">
                <livewire:web.league-detail :league-model="$league"/>
        </div>
    </x-web.layouts.dashboard>
</x-web.layouts.app>
