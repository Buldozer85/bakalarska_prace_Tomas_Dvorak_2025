<x-admin.layouts.app title="Upravit kolo č. {{ $leagueRound->number }}, {{ $leagueRound->from_to }} {{ $league->year }}" page="league">
    <div class="max-w-[1400px] mx-auto" x-data="{
        tab: 'round-info'
    }">


    <div>
        <x-admin.button :route="route('administration.league.detail', $league->id)" class="w-[100px] flex flex-row items-center gap-x-4" type="black">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
            </svg>
            <span>
                  Zpět
                </span>

        </x-admin.button>
    </div>

    <div class="border-b border-gray-200 mt-12">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500">
            <li class="me-2">
                <a @click="tab = 'round-info'" x-bind:class="tab === 'round-info' ? 'text-brand-black border-brand-black active' : 'border-transparent'" class="inline-flex items-center justify-center p-4 border-b-2  rounded-t-lg hover:text-gray-600 hover:border-gray-300 group cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 me-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 0 0 2.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 0 1 2.916.52 6.003 6.003 0 0 1-5.395 4.972m0 0a6.726 6.726 0 0 1-2.749 1.35m0 0a6.772 6.772 0 0 1-3.044 0" />
                    </svg>
                    Kolo
                </a>
            </li>
            <li class="me-2">
                <a @click="tab = 'round-players'" x-bind:class="tab === 'round-players' ? 'text-brand-black border-brand-black active' : 'border-transparent'" class="inline-flex items-center justify-center p-4 border-b-2 hover:text-gray-600 hover:border-gray-300 rounded-t-lg group cursor-pointer" aria-current="page">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 me-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    Hráči co již hráli
                </a>
            </li>
        </ul>
    </div>

    <div class="shadow-lg rounded-md p-12 space-y-12 " x-show="tab === 'round-info'">
        <form class="space-y-4" method="POST" action="{{ route('administration.league.round.update', ['league' => $league, 'leagueRound' => $leagueRound]) }}">
            @method('PUT')
            @csrf
            <div class="grid grid-cols-2 gap-4 gap-x-8 pb-12">
                <x-admin.form.input type="number" id="number" name="number" label="Číslo kola" :value="old('number') ?? $leagueRound->number"/>
                <x-admin.form.input type="date" id="from" name="from" label="Od" :value="old('from') ?? $leagueRound->from->format('Y-m-d')"/>
                <x-admin.form.input type="date" id="to" name="to" label="Do" :value="old('to') ?? $leagueRound->to->format('Y-m-d')"/>
            </div>

            <div class="flex justify-end">
                <x-admin.button class="w-[250px]" action="submit" type="yellow">Uložit</x-admin.button>
            </div>
        </form>
    </div>

        <div x-show="tab === 'round-players'"  class="shadow-lg rounded-md">
            <livewire:admin.league-round-players-manager :$leagueRound/>
        </div>
    </div>
</x-admin.layouts.app>
