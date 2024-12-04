<x-admin.layouts.app title="Úprava nastavení" page="website-settings">
    <div class="shadow-lg rounded-md p-12 space-y-12 max-w-[1400px] mx-auto">
        <div>
            <x-admin.button :route="route('administration.websiteSetting.index')" class="w-[100px] flex flex-row items-center gap-x-4" type="black">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                </svg>
                <span>
                  Zpět
                </span>

            </x-admin.button>
        </div>
        <form class="space-y-4" method="POST" action="{{ route('administration.websiteSetting.update', $websiteSetting->id) }}">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4 gap-x-8 pb-12">
                <x-admin.form.input id="key" name="key" label="Klíč" value="{{ $websiteSetting->key }}"/>
                <x-admin.form.input id="value" name="value" label="Hodnota" value="{{ $websiteSetting->value }}"/>
            </div>

            <div class="flex justify-end">
                <x-admin.button class="w-[250px]" action="submit" type="yellow">Uložit</x-admin.button>
            </div>
        </form>
    </div>
</x-admin.layouts.app>
