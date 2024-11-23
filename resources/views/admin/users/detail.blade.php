<x-admin.layouts.app title="Úprava uživatele" page="users">
    <div class="shadow-lg rounded-md p-12 space-y-12 max-w-[1400px] mx-auto">
        <div class="flex justify-between">
            <x-admin.button :route="route('administration.users.index')" class="w-[100px] flex flex-row items-center gap-x-4" type="black">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                </svg>
                <span>
                  Zpět
                </span>

            </x-admin.button>

                <x-admin.button data-modal-target="deleteUserModal" data-modal-toggle="deleteUserModal" class="w-[100px]" type="danger">Smazat</x-admin.button>


        </div>
        <form class="space-y-4" method="POST" action="{{ route('administration.users.user.update', $user->id) }}">
            @method('PUT')
            @csrf
            <div class="grid grid-cols-2 gap-4 gap-x-8 border-b border-b-gray-200 pb-12">
                <x-admin.form.input id="first_name" name="first_name" value="{{ $user->first_name }}" label="Jméno"/>
                <x-admin.form.input id="last_name" name="last_name" value="{{ $user->last_name }}" label="Příjmení"/>
                <x-admin.form.input id="email" name="email" value="{{ $user->email }}" label="E-mail"/>
                <x-admin.form.input id="phone" name="phone" value="{{ $user->phone }}" label="Telefon"/>
                <x-admin.form.select id="role" name="role" selected="{{ $user->role }}" label="Role" :options="\App\Enums\Roles::options()"/>
                <x-admin.form.select id="email_verified_at" name="email_verified_at" :selected="is_null($user->email_verified_at) ? 0 : 1" label="Ověřený e-mail" :options="['Ne', 'Ano']"/>
            </div>
            <div class="grid grid-cols-2 gap-4 gap-x-8 pt-4">
                <x-admin.form.input id="password" type="password" name="password" label="Heslo"/>
                <x-admin.form.input id="password_confirmation" name="password_confirmation" type="password" label="Heslo znovu"/>
            </div>
            <div class="flex justify-end">
                <x-admin.button class="w-[250px]" action="submit" type="yellow">Uložit</x-admin.button>
            </div>
        </form>
      <x-admin.delete-model-modal :action="route('administration.users.user.delete', $user->id)" id="deleteUserModal" :model="$user">
          Opravdu si přejete smazat uživatele {{ $user->full_name }}?
      </x-admin.delete-model-modal>
    </div>
</x-admin.layouts.app>
