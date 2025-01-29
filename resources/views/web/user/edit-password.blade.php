<x-web.layouts.app page="change-password" title="Změna hesla">
    <x-web.layouts.dashboard site="zmena-hesla">
        <div class="mx-auto xl:w-[900px] ">
            <div class="shadow-lg p-12 space-y-8">
                <h1 class="font-bold space-y-8 text-2xl">Změna hesla</h1>
                <form class="space-y-3" method="POST" action="{{ route('profile.change-password') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-4">
                            <x-web.form.input name="password" id="password" type="password" label="Heslo" required/>
                            <x-web.form.input name="password_confirmation" id="password_confirmation" label="Heslo znovu" required type="password"/>
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
