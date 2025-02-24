<x-admin.layouts.app title="Vytvořit kolo" page="league">
    <div class="shadow-lg rounded-md p-12 space-y-12 max-w-[1400px] mx-auto">
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
        <form class="space-y-4" method="POST" action="{{ route('administration.league.round.create', $league->id) }}">
            @csrf
            <div class="grid grid-cols-2 gap-4 gap-x-8 pb-12">
                <x-admin.form.input type="number" id="number" name="number" label="Číslo kola" :value="old('number') ?? ''"/>
                <x-admin.form.input type="date" id="from" name="from" label="Od" :value="old('from') ?? ''"/>
                <x-admin.form.input type="date" id="to" name="to" label="Do" :value="old('to') ?? ''"/>
            </div>

            <div class="flex justify-end">
                <x-admin.button class="w-[250px]" action="submit" type="yellow">Uložit</x-admin.button>
            </div>
        </form>
    </div>

</x-admin.layouts.app>
