<x-admin.layouts.app title="Vytvoření uživatele" page="users">
    <div class="shadow-lg rounded-md p-12 space-y-12 max-w-[1400px] mx-auto">
        <div>
            <x-admin.button :route="route('administration.users.index')" class="w-[100px] flex flex-row items-center gap-x-4" type="black">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                </svg>
                <span>
                  Zpět
                </span>

            </x-admin.button>
        </div>
        <form class="space-y-4" method="POST" action="{{ route('administration.users.user.create') }}">
            @csrf
            <div class="grid grid-cols-2 gap-4 gap-x-8 border-b border-b-gray-200 pb-12">
                <x-admin.form.input id="first_name" name="first_name" label="Jméno" value="{{ old('first_name') }}"/>
                <x-admin.form.input id="last_name" name="last_name" label="Příjmení" value="{{ old('last_name') }}"/>
                <x-admin.form.input id="email" name="email" label="E-mail" value="{{ old('email') }}"/>
                <x-admin.form.input id="phone" name="phone"  label="Telefon" value="{{ old('phone') }}"/>
                <x-admin.form.select id="role" name="role" label="Role" :options="\App\Enums\Roles::options()" :selected="old('role')"/>
                <x-admin.form.select id="email_verified_at" name="email_verified_at"  :selected="2 ?? old('email_verified_at')"  label="Ověřený e-mail" :options="['Ne', 'Ano', 'Ano/Ne']"/>
            </div>
            <div class="grid grid-cols-2 gap-4 gap-x-8 pt-4">
                <x-admin.form.input id="password" type="password" name="password" label="Heslo"/>
                <x-admin.form.input id="password_confirmation" name="password_confirmation" type="password" label="Heslo znovu"/>
            </div>
            <div class="flex justify-end">
                <x-admin.button class="w-[250px]" action="submit" type="yellow">Uložit</x-admin.button>
            </div>
        </form>
    </div>
</x-admin.layouts.app>
