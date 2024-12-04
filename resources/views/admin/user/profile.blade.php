<x-admin.layouts.app title="Úprava profilu" page="users">
    <div class="shadow-lg rounded-md p-12 space-y-12 max-w-[1400px] mx-auto" x-data="{
        seletedTab: 'general'
    }">

        <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 dark:text-gray-400">
            <li class="me-2">
                <a @click="seletedTab = 'general'" x-bind:class="seletedTab === 'general' ? 'bg-brand-yellow active' : 'bg-white'" class="inline-block px-4 py-3 rounded-lg text-black cursor-pointer">Základní informace</a>
            </li>
            <li class="me-2">
                <a @click="seletedTab = 'user-address'" x-bind:class="seletedTab === 'user-address' ? 'bg-brand-yellow active' : 'bg-white'" class="inline-block px-4 py-3 rounded-lg text-black cursor-pointer">Adresa</a>
            </li>
        </ul>

        <form class="space-y-4"
              method="POST"
              action="{{ route('administration.user.profile.update') }}"
              x-show="seletedTab === 'general'"
              x-transition
              x-transition.duration.250ms
              x-transition.scale.origin.top
              x-transition:enter.delay.50ms
              x-cloak>
            @method('PUT')
            @csrf
            <div class="grid grid-cols-2 gap-4 gap-x-8 border-b border-b-gray-200 pb-12">
                <x-admin.form.input id="first_name" name="first_name" value="{{ user()->first_name }}" label="Jméno"/>
                <x-admin.form.input id="last_name" name="last_name" value="{{ user()->last_name }}" label="Příjmení"/>
                <x-admin.form.input id="email" name="email" value="{{ user()->email }}" label="E-mail"/>
                <x-admin.form.input id="phone" name="phone" value="{{ user()->phone }}" label="Telefon"/>
            </div>
            <div class="grid grid-cols-2 gap-4 gap-x-8 pt-4">
                <x-admin.form.input id="password" type="password" name="password" label="Heslo"/>
                <x-admin.form.input id="password_confirmation" name="password_confirmation" type="password" label="Heslo znovu"/>
            </div>
            <div class="flex justify-end">
                <x-admin.button class="w-[250px]" action="submit" type="yellow">Uložit</x-admin.button>
            </div>
        </form>

        <form class="space-y-4"
              method="POST"
              action="{{ is_null(user()->address) ? route('administration.user.profile.address.create') : route('administration.user.profile.address.update') }}"
              x-show="seletedTab === 'user-address'"
              x-transition
              x-transition.duration.250ms
              x-transition.scale.origin.top
              x-transition:enter.delay.50ms
              x-cloak>

            @if(!is_null(user()->address))
                @method('PUT')
            @endif

            @csrf
            <div class="grid grid-cols-2 gap-4 gap-x-8 pb-12">
                <x-admin.form.input id="street" name="street" value="{{ user()?->address->street ?? '' }}" label="Ulice"/>
                <x-admin.form.input id="number" name="number" value="{{ user()?->address->number ?? '' }}" label="Č.P."/>
                <x-admin.form.input id="town" name="town" value="{{ user()?->address->town ?? '' }}" label="Město"/>
                <x-admin.form.input id="postcode" name="postcode" value="{{ user()?->address->postcode ?? '' }}" label="PSČ"/>
                <x-admin.form.input id="country" name="country" value="{{ user()?->address->country ?? '' }}" label="Země"/>
            </div>
            <div class="flex justify-end">
                <x-admin.button class="w-[250px]" action="submit" type="yellow">Uložit</x-admin.button>
            </div>
        </form>
    </div>
</x-admin.layouts.app>
