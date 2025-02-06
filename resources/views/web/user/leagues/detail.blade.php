<x-web.layouts.app page="my-league" title="{{ $league->name }}">
    <x-web.layouts.dashboard>
        <div class="flex justify-center md:justify-between items-center">
            <h1 class="text-xl text-black font-bold border-b-4 border-brand-darker text-center mt-4 mx-4 max-w-[300px] pb-2">{{ $league->name }}</h1>
        </div>

        <div class="lg:mt-20 max-w-7xl space-y-16 flex flex-col md:flex-row justify-center md:justify-between ">
                <livewire:web.league-detail :$league/>
        </div>


    </x-web.layouts.dashboard>
</x-web.layouts.app>
