<div x-data="{
    editScore(roundPivotId) {
        const score = parseFloat(document.querySelector('#score-' + roundPivotId).value);
        $wire.editScore(roundPivotId, score)
    }
}">


    <div class="relative overflow-x-auto w-full">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Zapsáno
                </th>
                <th scope="col" class="px-6 py-3">
                    Jméno
                </th>
                <th scope="col" class="px-6 py-3">
                    E-mail
                </th>
                <th scope="col" class="px-6 py-3">
                    Nahrané skóre
                </th>
                <th scope="col" class="px-6 py-3">
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($leagueRound->leaguePlayers as $player)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $player->pivot->created_at->format('j. n. Y G:i') }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                       {{ $player->user->full_name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $player->user->email }}
                    </td>
                    @if(is_null($player->pivot->confirmed))
                        <td class="px-6 py-4">
                            <x-admin.form.input value="{{ $player->pivot->score  ?? 0}}" id="score-{{$player->pivot->id}}" name="score-{{$player->pivot->id}}"/>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex flex-row gap-x-4" x-data="{
                                pivotId: '{{ $player->pivot->id }}',

                            }">
                                <x-admin.button x-on:click="$wire.editScore(pivotId, parseFloat(document.querySelector('#score-' + pivotId).value))"  type="yellow">Upravit</x-admin.button>
                                <x-admin.button wire:click.prevent="confirmScore({{ $player->pivot->id  }})">Potvrdit</x-admin.button>
                            </div>
                        </td>
                    @else
                        <td class="px-6 py-4">
                            {{ $player->pivot->score  ?? 0}}
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex flex-row gap-x-4">
                                <x-admin.button type="danger" wire:click.prevent="confirmScore({{ $player->pivot->id  }})">Zrušit potvrzení</x-admin.button>
                            </div>
                        </td>

                    @endif

                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    @if(session()->has('flashMessage'))
        <x-admin.toast :type="session('flashMessage')['type']" :message="session('flashMessage')['message']"/>
    @endif
</div>
