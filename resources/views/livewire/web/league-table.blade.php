<div class="gap-y-8 flex flex-col justify-center" x-data="{
    selectedTab: $wire.entangle('selectedTab').live
}">
    <div class="max-w-[350px] max-md:mx-auto">
        <x-web.form.select wire:model.live="selectedLeague" id="years" name="years" label="Ročník" :options="$this->getLeagueSelect()"></x-web.form.select>
    </div>
    <div class="max-lg:flex max-lg:flex-row max-lg:justify-center">
        <x-web.button @click="selectedTab = 'weekly'" :type="$selectedTab === 'weekly' ? 'black' : 'secondary'">Po týdnech</x-web.button>
        <x-web.button @click="selectedTab = 'results'" :type="$selectedTab === 'results' ? 'black' : 'secondary'">Celkové výsledky</x-web.button>
    </div>
    <div x-show="selectedTab === 'weekly'">
        <div class="flex flex-row gap-x-4">
            @foreach($leagueRounds as $round)
                <x-web.league-round wire:click="setSelectedRound({{ $round->number }})" :selected="$round->id === $selectedRound"  number="{{ $round->number }}" id="{{ $round->number }}" date="{{ $round->from_to }}" year="{{ $round->from->year }}" />
            @endforeach

        </div>

        <div class="flex flex-col sm:flex-row justify-between items-center max-sm:gap-y-4 mt-12">
            <div class="pb-4 max-sm:w-full">
                <div class="flex">
                    <label for="table-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Jméno</label>

                    <div class="relative w-full">
                        <input wire:model.live="name" type="search" id="table-search" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-brand focus:border-brand" placeholder="Vyhledat jméno" />
                        <span type="submit" class="absolute top-0 end-0 h-full p-2.5 text-sm font-medium text-white bg-brand-black rounded-e-lg border border-brand-black focus:ring-4 focus:outline-none focus:ring-brand-black">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                            <span class="sr-only">Search</span>
                        </span>
                    </div>
                </div>
            </div>

        </div>

        <div class="relative overflow-x-auto sm:rounded-lg max-sm:space-y-6">


            <table class="w-full text-sm text-left rtl:text-right text-gray-500 shadow-md">
                <thead class="text-xs text-brand-black uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 font-bold">
                        Pořadí
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Soutěžící
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Bodů v tomto kole
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Bodů celkem po tomto kole
                    </th>

                </tr>
                </thead>
                <tbody>
                @foreach($this->getRoundPlayers() as $player)
                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                           {{ $loop->index + 1 }}.
                        </th>
                        <td class="px-6 py-4">
                           {{ $player->user->full_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $player->pivot->score }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $player->getScoreToRound($this->selectedRound) }}
                        </td>

                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <div x-show="selectedTab === 'results'">

        <div class="flex flex-col sm:flex-row justify-between items-center max-sm:gap-y-4 mt-12">
            <div class="pb-4 max-sm:w-full">
                <div class="flex">
                    <label for="table-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Jméno</label>

                    <div class="relative w-full">
                        <input wire:model.live="name" type="search" id="table-search" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-brand focus:border-brand" placeholder="Vyhledat jméno" />
                        <span type="submit" class="absolute top-0 end-0 h-full p-2.5 text-sm font-medium text-white bg-brand-black rounded-e-lg border border-brand-black focus:ring-4 focus:outline-none focus:ring-brand-black">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                            <span class="sr-only">Search</span>
                        </span>
                    </div>
                </div>
            </div>

        </div>

        <div class="relative overflow-x-auto sm:rounded-lg max-sm:space-y-6">


            <table class="w-full text-sm text-left rtl:text-right text-gray-500 shadow-md">
                <thead class="text-xs text-brand-black uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 font-bold">
                        Pořadí
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Soutěžící
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Bodů celkem
                    </th>

                </tr>
                </thead>
                <tbody>

                @foreach($this->getAllPlayers() as $player)

                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $player->rank }}.
                        </th>
                        <td class="px-6 py-4">
                            {{ $player->user->full_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $player->score ?? 0 }}
                        </td>


                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

</div>
