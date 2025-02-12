<x-web.layouts.app page="my-league" title="Moje liga">
    <x-web.layouts.dashboard site="moje-liga">
        <h1 class="text-3xl text-black font-bold border-b-4 border-brand-darker text-center md:text-left mt-4 max-w-[130px] pb-2 max-md:mx-auto">Moje liga</h1>

        <div class="border-b border-gray-200 pb-20">
            <livewire:web.league-profile-selector/>
        </div>


        <h2 class="text-xl font-bold mt-12 max-md:text-center">Moje ligy</h2>

        <div class="mt-12 grid grid-cols-1 max-md:justify-items-center lg:grid-cols-2 xl:grid-cols-3 gap-y-12 pb-12">
            @foreach(user()->leaguesWithRounds as $league)
                <div class="bg-brand text-white text-center px-8 py-6 !space-y-4 max-w-[300px] rounded-md shadow-lg">
                    <p class="text-xl font-bold pb-4 h-16">{{ $league->name }}</p>
                    <p class="text-lg pb-4">{{ $league->from_to }}</p>
                    <x-web.button class="!border-none text-brand-black " type="white" :route="route('profile.user.league.detail', $league->id)">Zobrazit</x-web.button>
                </div>
            @endforeach

        </div>
    </x-web.layouts.dashboard>
</x-web.layouts.app>
