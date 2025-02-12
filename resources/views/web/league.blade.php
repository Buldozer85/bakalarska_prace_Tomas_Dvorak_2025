<x-web.layouts.app page="league" title="Kuželkářská liga">
<div class="max-w-nav mx-auto mt-12">
    <div class="flex flex-row justify-center md:justify-between items-center mx-8">
        <div class="space-y-8 flex flex-col justify-center">
            <x-web.heading>Kuželkářská <span class="text-brand-black">liga</span></x-web.heading>
            <x-web.heading-subtitle>Podívejte se na výsledky naší každoroční ligy</x-web.heading-subtitle>
            <x-web.button class="!text-xl text-center max-w-[250px] max-md:mx-auto" type="yellow">Mrkněte na tabulku!</x-web.button>
        </div>

        <img alt="Obrázek kuželek a zeleným oválem v pozadí" class="max-md:hidden" src="{{ asset('images/league.png') }}">
    </div>

    <div class="mx-8 mt-[600px] pb-12">
        <div class="md:bg-brand rounded-xl w-full h-[450px] lg:h-[800px] mt-32 lg:mt-72">
            @if(\App\Models\League::count() > 0)
                <div class="max-w-[1300px] relative mx-auto top-[-110%] lg:top-[-50%]">
                    <livewire:web.league-table></livewire:web.league-table>
                </div>
            @else
                <div class="relative w-full h-32">
                    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 text-white p-4">
                        <h3 class="text-white text-2xl text-center">Momentálně se zde nenachází žádná liga</h3>
                    </div>
                </div>

            @endif

        </div>
    </div>
</div>
</x-web.layouts.app>
