<div x-data="{
    selectedUser: {{ array_key_first($users) }},
    addUser() {
          $wire.addPlayer(this.selectedUser)

    },
    round: {
        number: '',
        id: ''
    }
}" x-init="$wire.on('player-added', (data) => {
     setTimeout(()=> {

         selectedUser = data.selectedUser
     }, 50)

})">
    <div class="shadow-lg rounded-md p-12 space-y-12 max-w-[1400px] mx-auto">

        <div class="space-y-4">
            <div x-show="tab === 'league-info'">
                <div class="grid grid-cols-2 gap-4 gap-x-8 pb-12">
                    <x-admin.form.input wire:model.blur="name" id="name" name="name" label="Název" :value="old('name') ?? ''"/>
                    <x-admin.form.input wire:model.blur="year" type="number"  id="year" name="year" label="Rok" :value="old('year') ?? ''"/>
                    <x-admin.form.input type="date" wire:model.blur="start" id="start" name="start" label="Začátek" :value="old('start') ?? ''"/>
                    <x-admin.form.input type="date" id="end" wire:model.blur="end" name="end" label="Konec" :value="old('end') ?? ''"/>
                </div>

                <x-admin.form.textarea wire:model.blur="description" name="description" id="description" label="Popis">{{ old('description') ?? '' }}</x-admin.form.textarea>
            </div>


            <div class="space-y-8 divide-y-2 divide-gray-200" x-show="tab === 'league-players'">
                @if(!empty($users))
                    <div class="flex flex-row items-center gap-x-4  ">
                        <x-admin.form.select x-model="selectedUser" :options="$users" name="players" id="players" />
                        <x-admin.button @click.prevent="addUser; ">Přidat Hráče</x-admin.button>
                    </div>
                @endif




                <div class="pt-12 space-y-4">
                    <h2 class="text-xl font-bold">Přidaní hráči</h2>


                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-900 uppercase">
                            <tr>
                                <th scope="col" class="py-3">
                                    Jméno
                                </th>
                                <th scope="col" class="py-3">
                                    E-mail
                                </th>
                                <th scope="col" class="py-3">
                                    Skóre
                                </th>
                                <th scope="col" class="py-3">
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($usersInLeague as $player)
                                <tr class="bg-white">
                                    <th scope="row" class="py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $player->full_name }}
                                    </th>
                                    <td class="py-4">
                                        {{  $player->email }}
                                    </td>
                                    <td class="py-4">
                                        {{  $player->pivot->score ?? 0 }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <svg @click="$wire.removePlayer({{ $player->id}})" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-brand-reserved cursor-pointer">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                        </svg>

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div class="grid grid-cols-4 ">

                   </div>


                </div>
            </div>

            <div class="space-y-8 divide-y-2 divide-gray-200" x-show="tab === 'league-rounds'">
                <div class="flex flex-row items-center gap-x-4  ">
                    <x-admin.button :route="route('administration.league.round.show-create', $league->id)">Vytvořit kolo</x-admin.button>
                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 ">
                    @foreach($league->rounds as $round)
                        <div class="flex flex-row gap-x-4 items-center mt-12">
                            <span>
                                {{ $round->number }}. Kolo
                            </span>

                            <x-admin.button :route="route('administration.league.round.detail', ['league' => $league->id, 'leagueRound' => $round->id])" type="black">Zobrazit</x-admin.button>


                            <svg @click="round.id = '{{ $round->id}}'; round.number = '{{ $round->number}}'" data-modal-target="deleteRoundModal" data-modal-toggle="deleteRoundModal" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-brand-reserved cursor-pointer">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>

                        </div>

                    @endforeach
                </div>


            </div>



            <div class="flex justify-end">
                <x-admin.button class="w-[250px]" action="submit" type="yellow">Uložit</x-admin.button>
            </div>
        </div>
    </div>

    @if(!is_null($league->rounds->first()))
        <x-admin.modal id="deleteRoundModal">
            <div class="flex flex-col justify-center items-center gap-y-6">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-14 text-brand-reserved">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                </svg>

                <h3 class="text-xl font-bold">Smazat záznam</h3>

                <p class="font-normal">Opravdu si přejete smazat kolo č.<span x-text="round.number"></span>?</p>

                <div class="flex flex-row gap-x-4 w-full">

                    <x-admin.button data-modal-hide="deleteRoundModal" class="flex-1" @click="$wire.deleteRound(round.id)" action="submit" type="danger">Smazat</x-admin.button>
                    <x-admin.button data-modal-hide="deleteRoundModal" class="flex-1" type="yellow">Zrušit</x-admin.button>
                </div>
            </div>
        </x-admin.modal>
    @endif


</div>
