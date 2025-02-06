<div class="mt-12">

    <div class="max-w-[350px]">
        <x-web.form.select label="Probíhající liga" id="activeLeague" name="activeLeague" wire:model="selectedLeague" :options="$this->getLeagueSelect()"/>
    </div>

    @if(!is_null($currentRound))
        <div class="mt-12 space-y-8">
            <h2 class="text-xl font-bold">Současné kolo</h2>
            <table class="shadow-lg text-center">
                <tr class="">
                    <th class="p-4 border-2 border-gray-200 w-[150px]">Kolo</th>
                    <th class="p-4 border-2 border-gray-200 w-[150px]">Od</th>
                    <th class="p-4 border-2 border-gray-200 w-[150px]">Do</th>
                    <th class="p-4 border-2 border-gray-200 w-[150px]">Výsledek</th>
                    <th class="p-4 border-2 border-gray-200 w-[150px]">Body po kole</th>
                </tr>
                <tr>
                    <td class="border-2 border-gray-200 p-4">{{ $currentRound->number }}.</td>
                    <td class="border-2 border-gray-200 p-4">{{ $currentRound->from->format('j. n. Y') }}</td>
                    <td class="border-2 border-gray-200 p-4">{{ $currentRound->to->format('j. n. Y') }}</td>
                    <td class="border-2 border-gray-200 p-4">{{ $currentRound->leaguePlayers->where('user_id', '=', user()->id)->first()->pivot->score ?? 'Neodehráno' }}</td>
                    <td class="border-2 border-gray-200 p-4">{{  $currentRound->leaguePlayers->where('user_id', '=', user()->id)->first()?->getScoreToRound($currentRound->number) ?? 0 }}</td>
                </tr>
            </table>
        </div>
    @else
        <div class="mt-12 space-y-8">
            <h2 class="text-xl font-bold">Momentálně neprobíhá žádné kolo vybrané ligy</h2>
        </div>
    @endif



    @if(!is_null($previousRound))
        <div class="mt-12 space-y-8">
            <h2 class="text-xl font-bold">Minulé kolo</h2>
            <table class="shadow-lg text-center">
                <tr class="">
                    <th class="p-4 border-2 border-gray-200 w-[150px]">Kolo</th>
                    <th class="p-4 border-2 border-gray-200 w-[150px]">Od</th>
                    <th class="p-4 border-2 border-gray-200 w-[150px]">Do</th>
                    <th class="p-4 border-2 border-gray-200 w-[150px]">Výsledek</th>
                    <th class="p-4 border-2 border-gray-200 w-[150px]">Body po kole</th>
                </tr>
                <tr>
                    <td class="border-2 border-gray-200 p-4">{{ $previousRound->number }}.</td>
                    <td class="border-2 border-gray-200 p-4">{{ $previousRound->from->format('j. n. Y') }} </td>
                    <td class="border-2 border-gray-200 p-4">{{ $previousRound->to->format('j. n. Y') }} </td>
                    <td class="border-2 border-gray-200 p-4">{{ $previousRound->leaguePlayers->where('user_id', '=', user()->id)->first()->pivot->score ?? 'Neodehráno' }}</td>
                    <td class="border-2 border-gray-200 p-4">{{  $previousRound->leaguePlayers->where('user_id', '=', user()->id)->first()?->getScoreToRound($previousRound->number) ?? 0 }}</td>
                </tr>
            </table>
        </div>
    @endif

</div>
