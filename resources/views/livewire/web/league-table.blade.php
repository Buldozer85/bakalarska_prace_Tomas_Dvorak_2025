<div class="space-y-8 flex flex-col justify-center">
    <div class="max-w-[350px] max-md:mx-auto">
        <x-web.form.select id="years" name="years" label="Ročník" :options="['16-2024' => '16. ročník - 2024']"></x-web.form.select>
    </div>
    <div class="max-lg:flex max-lg:flex-row max-lg:justify-center">
        <x-web.button wire:click="setView('weekly')" :type="$selectedView === 'weekly' ? 'black' : 'secondary'">Po týdnech</x-web.button>
        <x-web.button wire:click="setView('results')" :type="$selectedView === 'results' ? 'black' : 'secondary'">Celkové výsledky</x-web.button>
    </div>
    @if($selectedView === 'weekly')
<div>
    <x-web.league-round number="1" id="1" date="9.10. - 16.10." />
</div>

        <div class="flex flex-col sm:flex-row justify-between items-center max-sm:gap-y-4">
            <div class="pb-4 max-sm:w-full">
                <label for="table-search">Vyhledat hráče</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none bg-brand-black rounded-l-lg px-4">
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" id="table-search" class="block pt-2 ps-12 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 focus:outline-0 sm:ml-2 max-sm:w-full" placeholder="Vyhledejte jméno">
                </div>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center max-sm:w-full gap-x-4">
                <label class="text-brand-black font-bold">
                    Na stránku:
                </label>
                <select><option>xd</option></select>
            </div>
        </div>

    <div class="relative overflow-x-auto sm:rounded-lg max-sm:space-y-6">


        <table class="w-full text-sm text-left rtl:text-right text-gray-500 shadow-md">
            <thead class="text-xs text-brand-black uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 font-bold">
                    Pořadí
                </th>
                <th scope="col" class="px-6 py-3">
                    Soutěžící
                </th>
                <th scope="col" class="px-6 py-3">
                    Bodů v tomto kole
                </th>
                <th scope="col" class="px-6 py-3">
                    Bodů celkem
                </th>

            </tr>
            </thead>
            <tbody>
            <tr class="bg-white border-b">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    Apple MacBook Pro 17"
                </th>
                <td class="px-6 py-4">
                    Silver
                </td>
                <td class="px-6 py-4">
                    Laptop
                </td>
                <td class="px-6 py-4">
                    $2999
                </td>

            </tr>
            <tr class="bg-white border-b">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    Apple MacBook Pro 17"
                </th>
                <td class="px-6 py-4">
                    Silver
                </td>
                <td class="px-6 py-4">
                    Laptop
                </td>
                <td class="px-6 py-4">
                    $2999
                </td>

            </tr>
            <tr class="bg-white border-b">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    Apple MacBook Pro 17"
                </th>
                <td class="px-6 py-4">
                    Silver
                </td>
                <td class="px-6 py-4">
                    Laptop
                </td>
                <td class="px-6 py-4">
                    $2999
                </td>

            </tr>
            </tbody>
        </table>
    </div>
    @endif

</div>
