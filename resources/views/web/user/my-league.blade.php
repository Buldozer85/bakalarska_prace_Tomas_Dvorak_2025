<x-web.layouts.app page="my-league" title="Moje liga">
    <x-web.layouts.dashboard site="moje-liga">
        <h1 class="text-3xl text-black font-bold border-b-4 border-brand-darker text-center mt-4 mx-4 max-w-[300px] pb-2">Moje liga</h1>

        <livewire:web.league-profile-selector/>

        <h2 class="text-xl font-bold mt-12">Moje ligy</h2>

        <div class="mt-12 grid grid-cols-3 gap-y-12">
            @foreach(user()->leagues as $league)
                <div class="bg-brand text-white text-center p-4 !space-y-12 max-w-[300px] rounded-md shadow-lg">
                    <p class="text-xl font-bold pt-4 pb-6">{{ $league->name }}</p>
                    <x-web.button class="!border-none text-brand-black " type="white" :route="route('profile.user.league.detail', $league->id)">Zobrazit</x-web.button>
                </div>
            @endforeach

        </div>
    </x-web.layouts.dashboard>
</x-web.layouts.app>
