<x-web.layouts.app title="Změna osobních údajů">
    <x-web.layouts.dashboard site="zmena-osobnich-udaju">
        <div class="mx-auto xl:w-[900px] ">
            <div class="shadow-lg p-12 space-y-8">
                <h1 class="font-bold space-y-8 text-2xl">Změna údajů</h1>
                <form class="space-y-3 " method="POST" action="{{ route('profile.update-information') }}">
                    @csrf
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 gap-y-2">
                        <x-web.form.input name="first_name" id="first_name" label="Jméno" required value="{{ user()->first_name }}" />
                        <x-web.form.input name="last_name" id="last_name" label="Příjmení" required value="{{ user()->last_name }}" />
                        <x-web.form.input name="phone" id="phone" label="Telefon" required value="{{ user()->phone }}" />
                    </div>

                    <div class="flex justify-end">
                        <x-web.button type="primary" button-type="submit" display-bg>
                            Uložit
                        </x-web.button>
                    </div>
                </form>
            </div>

        </div>
    </x-web.layouts.dashboard>
</x-web.layouts.app>

