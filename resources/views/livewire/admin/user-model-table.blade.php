<div class="overflow-x-auto shadow-md sm:rounded-lg max-w-[1400px] mx-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <x-admin.table-header column="id" :sort-direction="$sortDirection" :sort-by="$sortBy">
                ID
            </x-admin.table-header>

            <x-admin.table-header column="email" :sort-direction="$sortDirection" :sort-by="$sortBy">
                E-mail
            </x-admin.table-header>

            <x-admin.table-header column="first_name" :sort-direction="$sortDirection" :sort-by="$sortBy">
                Jméno
            </x-admin.table-header>


            <x-admin.table-header column="last_name" :sort-direction="$sortDirection" :sort-by="$sortBy">
                Příjmení
            </x-admin.table-header>

            <x-admin.table-header column="role" :sort-direction="$sortDirection" :sort-by="$sortBy">
                Role
            </x-admin.table-header>

            <x-admin.table-header column="phone" :sort-direction="$sortDirection" :sort-by="$sortBy">
                Telefon
            </x-admin.table-header>

            <th scope="col" class="px-6 py-3">
                Potvrzený<br> e-mail
            </th>
            <th scope="col" class="px-6 py-3">
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $user)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $user->id }}
                </th>
                <td class="px-6 py-4">
                    {{ $user->email }}
                </td>
                <td class="px-6 py-4">
                    {{ $user->first_name }}
                </td>
                <td class="px-6 py-4">
                    {{ $user->last_name }}
                </td>
                <td class="px-6 py-4">
                    {{ $user->role->label() }}
                </td>

                <td class="px-6 py-4">
                    {{ $user->phone }}
                </td>

                <td class="px-6 py-4">
                    {{ is_null($user->email_verified_at) ? 'Ne' : 'Ano' }}
                </td>
                <td class="px-6 py-4">
                    <div class="flex flex-row gap-x-4 items-center">
                        <div class="flex flex-row items-center gap-x-2">
                            <a href="{{ route('administration.users.user.detail', $user->id) }}" class="font-medium text-brand">Upravit</a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-brand">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>
                        </div>

                        <div class="flex flex-row items-center gap-x-2">
                            <a href="#" class="font-medium text-brand-reserved">Smazat</a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-brand-reserved">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>

                        </div>
                    </div>

                </td>
            </tr>
        @endforeach

        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            </th>
            <td class="px-6 py-4">
                <x-admin.form.input wire:model.live="email" type="email" name="email" id="email" placeholder="E-mail"></x-admin.form.input>
            </td>
            <td class="px-6 py-4">
                <x-admin.form.input wire:model.live="first_name" name="first_name" id="first_name" placeholder="Jméno"></x-admin.form.input>
            </td>
            <td class="px-6 py-4">
                <x-admin.form.input wire:model.live="last_name" name="last_name" id="last_name" placeholder="Příjmení"></x-admin.form.input>
            </td>
            <td class="px-6 py-4">
                <x-admin.form.select wire:model.live="role" id="role" :options="\App\Enums\Roles::options()"></x-admin.form.select>
            </td>

            <td class="px-6 py-4">
                <x-admin.form.input wire:model.live="phone" name="phone" id="phone" placeholder="Telefon"></x-admin.form.input>
            </td>

            <td class="px-6 py-4">
                <x-admin.form.select id="email_verified_at" name="email_verified_at" wire:model.live="email_verified_at" :options="['Ne', 'Ano', 'Ano/Ne']" :selected="2"></x-admin.form.select>
            </td>
            <td class="px-6 py-4">
                <x-web.button wire:click.prevent="resetFilters" class="w-full" type="black">Resetovat filtr</x-web.button>
            </td>
        </tr>
        </tbody>
    </table>
</div>
