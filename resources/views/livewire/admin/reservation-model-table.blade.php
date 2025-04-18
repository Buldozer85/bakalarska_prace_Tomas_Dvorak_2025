<div class="overflow-x-auto max-w-[1400px] mx-6 xl:mx-auto space-y-4" x-data="{
    model: {
        id: '',
        name: ''
    }
}">
    <div class="flex flex-row justify-between items-center">
        <div class="flex flex-row gap-x-4 items-center">
            <label for="perPage">Na stránku:</label>
            <x-admin.form.select wire:model.live="perPage" name="perPage" id="perPage" :options="$this->perPageOptions"/>
        </div>

    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 shadow-md sm:rounded-lg">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <x-admin.table-header column="id" :sort-direction="$sortDirection" :sort-by="$sortBy">
                ID
            </x-admin.table-header>

            <x-admin.table-header column="user_id" :sort-direction="$sortDirection" :sort-by="$sortBy">
                Uživatel
            </x-admin.table-header>

            <x-admin.table-header column="date" :sort-direction="$sortDirection" :sort-by="$sortBy">
                Datum
            </x-admin.table-header>

            <x-admin.table-header column="first_name" :sort-direction="$sortDirection" :sort-by="$sortBy">
                Od&nbsp;-&nbsp;Do
            </x-admin.table-header>

            <x-admin.table-header column="last_name" :sort-direction="$sortDirection" :sort-by="$sortBy">
                Typ&nbsp;rezervace
            </x-admin.table-header>

            <x-admin.table-header column="role" :sort-direction="$sortDirection" :sort-by="$sortBy">
                Rezervovatel
            </x-admin.table-header>

            <x-admin.table-header column="phone" :sort-direction="$sortDirection" :sort-by="$sortBy">
                Telefon
            </x-admin.table-header>

            <x-admin.table-header column="on_company" :sort-direction="$sortDirection" :sort-by="$sortBy">
                Na firmu
            </x-admin.table-header>
            <th scope="col" class="px-6 py-3">
                Status
            </th>
            <th scope="col" class="px-6 py-3">
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $reservation)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $reservation->id }}
                </th>
                <td class="px-2 py-4">
                    {{ $reservation->user->email }}
                </td>
                <td class="px-2 py-4">
                    {{ $reservation->date->format('j.n.Y') }}
                </td>

                <td class="px-2 py-4">
                    {{ $reservation->from_to }}
                </td>
                <td class="px-2 py-4">
                    {{ $reservation->type->label() }}
                </td>
                <td class="px-2 py-4">
                    {{ $reservation->customerInformation->full_name }}
                </td>

                <td class="px-2 py-4">
                    {{ $reservation->customerInformation->phone }}
                </td>

                <td class="px-2 py-4">
                    {{ $reservation->on_company_label }}
                </td>

                <td class="px-2 py-4">
                    <x-admin.status-badge :type="$reservation->status['key']">{{ $reservation->status['label'] }}</x-admin.status-badge>
                </td>


                <td class="px-2 py-4">
                    <div class="flex flex-row gap-x-4 items-center">
                        <div class="flex flex-row items-center gap-x-2">
                            <a href="{{ route('administration.reservation.detail', $reservation->id) }}" class="font-medium text-brand">Upravit</a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-brand">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>
                        </div>

                        <div class="flex flex-row items-center gap-x-2 cursor-pointer" @click="model.id = '{{ $reservation->id}}'; model.name = '{{ $reservation->user->email }}'" data-modal-target="deleteUserModal" data-modal-toggle="deleteUserModal">
                            <a class="font-medium text-brand-reserved cursor-pointer">Smazat</a>
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

            <td class="px-2 py-4 min-w-[250px]">
                <x-admin.form.input wire:model.live="user" name="user" id="user" placeholder="Uživatel"></x-admin.form.input>
            </td>


            <td class="px-2 py-4 min-w-[250px]">
                <x-admin.form.input wire:model.live="date" type="date" name="date" id="date" placeholder="Datum"></x-admin.form.input>
            </td>


            <td class="px-2 py-4 flex flex-row items-center gap-x-2 min-w-[250px]">
                <div class="py-4">
                    <x-admin.form.input type="number" min="0" wire:model.live.debounce="slot_from" name="slot_from" id="slot_from" placeholder="Od"></x-admin.form.input>

                </div>
                -
                <div class="px-2 py-4">
                    <x-admin.form.input type="number" min="{{ $slot_from ?? 0 }}" wire:model.live="slot_to" name="slot_to" id="slot_to" placeholder="Do"></x-admin.form.input>
                </div>
            </td>
            <td class="px-2 py-4 min-w-[250px]">
                <x-admin.form.select name="type" id="type" wire:model.live="type" :options="array_merge(['unselected' => 'Nevybráno'], \App\Enums\ReservationTypes::select())" selected="unselected"></x-admin.form.select>
            </td>
            <td class="px-2 py-4 min-w-[250px]">
                <x-admin.form.input wire:model.live="reservation_name" name="reservation_name" id="reservation_name" placeholder="Rezervovatel"></x-admin.form.input>
            </td>

            <td class="px-2 py-4 min-w-[250px]">
                <x-admin.form.input wire:model.live="phone" name="phone" id="phone" placeholder="Telefon"></x-admin.form.input>
            </td>
            <td class="px-2 py-4 min-w-[150px]">
                <x-admin.form.select name="on_company" id="on_company" name="on_company" wire:model.live="on_company" :options="['Ne', 'Ano', 'Ano/Ne']" :selected="2"></x-admin.form.select>
            </td>


            <td class="px-2 py-4 min-w-[250px]">
                <x-admin.form.select name="status" id="status" name="status" wire:model.live="status" :options="['unselected' => 'Vybrat status', 'confirmed' => 'Potvrzená', 'cancelled' => 'Zrušená', 'waiting' => 'Čeká na zpracování']" :selected="2"></x-admin.form.select>
            </td>
            <td class="px-2 py-4">
                <div class="mt-2">
                    <x-web.button wire:click.prevent="resetFilters" class="w-full" type="black">Resetovat filtr</x-web.button>
                </div>

            </td>
        </tr>
        </tbody>
    </table>

    <div class="w-full pt-12x">
        {{ $data->links() }}
    </div>

    @if(session()->has('flashMessage'))
        <x-admin.toast :type="session('flashMessage')['type']" :message="session('flashMessage')['message']"/>
    @endif


    <x-admin.modal id="deleteUserModal">
        <div class="flex flex-col justify-center items-center gap-y-6">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-14 text-brand-reserved">
                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
            </svg>

            <h3 class="text-xl font-bold">Smazat rezervaci!</h3>

            <p class="font-normal">Opravdu si přejete smazat rezervaci od <span x-text="model.name"></span>?</p>
            <p class="font-normal">Smazaná rezervace nejde obnovit!</p>

            <div class="flex flex-row gap-x-4 w-full">

                <x-admin.button data-modal-hide="deleteUserModal" class="flex-1" @click="$wire.delete(model.id)" action="submit" type="danger">Smazat</x-admin.button>
                <x-admin.button data-modal-hide="deleteUserModal" class="flex-1" type="yellow">Zrušit</x-admin.button>
            </div>
        </div>
    </x-admin.modal>
</div>

