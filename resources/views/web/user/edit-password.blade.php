<x-web.layouts.app title="Změna hesla">
    <x-web.layouts.dashboard site="zmena-hesla">
        <div class="mx-auto w-[900px] ">
            <div class="shadow-lg p-12 space-y-8">
                <h1 class="font-bold space-y-8 text-2xl">Změna hesla</h1>
                <form class="space-y-3" method="POST" action="{{ route('profile.change-password') }}">
                    @csrf
                    <div class="flex flex-row justify-between gap-x-12 items-center">
                        <div class="flex-1">
                            <x-web.form.input name="password" id="password" type="password" label="Heslo" required/>
                        </div>

                        <div class="flex-1">
                            <x-web.form.input name="password_confirmation" id="password_confirmation" label="Heslo znovu" required type="password"/>
                        </div>

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
