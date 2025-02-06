<div class="gap-y-8 flex flex-col justify-center" x-data="{
    selectedTab: $wire.entangle('selectedTab').live,
    showModal: false,
    round:  {
        score: {{ $roundPlayed->score ?? 0 }},
        number: {{ $round->number }}
    } ,
    setRoundScore() {
        $wire.setRoundScore(this.round.score)
    }

}" x-init="$wire.on('round-changed', (data) => {
setTimeout(() => {
    round.score = data.score;
    round.number = data.number

    if(document.querySelector('#round-number')) {
      document.querySelector('#round-number').innerText = data.number
    }

},50)


});  document.querySelector('#round-number') ? document.querySelector('#round-number').innerText = round.number : ''">

    <div class="max-lg:flex max-lg:flex-row max-lg:justify-center">
        <x-web.button @click="selectedTab = 'weekly'" :type="$selectedTab === 'weekly' ? 'black' : 'secondary'">Po týdnech</x-web.button>
        <x-web.button @click="selectedTab = 'results'" :type="$selectedTab === 'results' ? 'black' : 'secondary'">Celkové výsledky</x-web.button>
    </div>
    <div x-show="selectedTab === 'weekly'">
        <div class="flex flex-row gap-x-4">
            @foreach($league->rounds as $round)
                <x-web.league-round wire:key="{{ $round->id }}" wire:click="setSelectedRound({{ $round->id }})" :selected="$round->id === $selectedRound"  number="{{ $round->number }}" id="{{ $round->id }}" date="{{ $round->from_to }}" year="{{ $round->from->year }}" />
            @endforeach

        </div>

        @if(!$this->hasSubmittedRoundResult())
            <div class="mt-12">
                <x-web.button @click="showModal = true">Zpasat výsledek !</x-web.button>
            </div>
            <div x-show="showModal" x-transition.opacity.scale
                 class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
                <div class="relative w-full max-w-md bg-white rounded-lg shadow dark:bg-gray-700 transform transition-all scale-95">
                    <button @click="showModal = false" type="button"
                            class="absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Zavřít vyskakovací okno</span>
                    </button>
                    <div class="p-4 md:p-8 text-center space-y-8">
                       <h3 class="text-xl font-bold">Zapsat výsledek kola <span id="round-number"></span></h3>

                        <div class="flex flex-row gap-x-4 w-full justify-center">
                            <x-web.form.input x-model="round.score" id="score" name="score" type="number" min="0" placeholder="Výsledek" />
                            <x-web.button @click="setRoundScore; showModal = false">Zapsat</x-web.button>
                        </div>
                    </div>
                </div>
            </div>

        @else

            @if(is_null($roundPlayed->confirmed))
                <div class="mt-12">
                    <x-web.button @click="showModal = true">Upravit výsledek</x-web.button>
                </div>
                <div x-show="showModal" x-transition.opacity.scale
                     class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
                    <div class="relative w-full max-w-md bg-white rounded-lg shadow dark:bg-gray-700 transform transition-all scale-95">
                        <button @click="showModal = false" type="button"
                                class="absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Zavřít vyskakovací okno</span>
                        </button>
                        <div class="p-4 md:p-8 text-center space-y-8">
                            <h3 class="text-xl font-bold">Upravit výsledek kola <span id="round-number"></span></h3>

                            <div class="flex flex-row gap-x-4 w-full justify-center">
                                <x-web.form.input x-model="round.score" id="score" name="score" type="number" min="0" placeholder="Výsledek" />
                                <x-web.button @click="setRoundScore">Zapsat</x-web.button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif

        <div class="relative overflow-x-auto sm:rounded-lg max-sm:space-y-6 mt-12">


            <table class="w-full text-sm text-left rtl:text-right text-gray-500 shadow-md">
                <thead class="text-xs text-brand-black uppercase bg-gray-50">
                <tr>
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
                @foreach($this->getRoundPlayers()->where('id', '=', $this->player->id) as $player)
                    <tr class="bg-white border-b">

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

                @foreach($league->rankedLeaguePlayers as $player)
                    <tr class="border-b @if($player->user_id === user()->id) bg-gray-100 @else bg-white @endif">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $player->rank }}.
                        </th>
                        <td class="px-6 py-4">
                            {{ $player->user->full_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $player->score }}
                        </td>


                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>



</div>
