<x-web.layouts.app title="Moje liga">
    <x-web.layouts.dashboard site="moje-liga">
        <h1 class="text-3xl text-black font-bold border-b-4 border-brand-darker text-center mt-4 mx-4 max-w-[300px] pb-2">Moje liga</h1>

        <div class="mt-12 space-y-8">
            <h2 class="text-xl font-bold">Současné kolo</h2>
            <table class="shadow-lg text-center">
                <tr class="">
                    <th class="p-4 border-2 border-gray-200 w-[150px]">Kolo</th>
                    <th class="p-4 border-2 border-gray-200 w-[150px]">Od</th>
                    <th class="p-4 border-2 border-gray-200 w-[150px]">Do</th>
                    <th class="p-4 border-2 border-gray-200 w-[150px]">Výsledek</th>
                    <th class="p-4 border-2 border-gray-200 w-[150px]">Body po kole</th>
                </tr>
                <tr>
                    <td class="border-2 border-gray-200 p-4">2.</td>
                    <td class="border-2 border-gray-200 p-4">9.10.2024</td>
                    <td class="border-2 border-gray-200 p-4">15.10.2024</td>
                    <td class="border-2 border-gray-200 p-4">Neodehráno</td>
                    <td class="border-2 border-gray-200 p-4">110</td>
                </tr>
            </table>
        </div>

        <div class="mt-12 space-y-8">
            <h2 class="text-xl font-bold">Minulé kolo</h2>
            <table class="shadow-lg text-center">
                <tr class="">
                    <th class="p-4 border-2 border-gray-200 w-[150px]">Kolo</th>
                    <th class="p-4 border-2 border-gray-200 w-[150px]">Od</th>
                    <th class="p-4 border-2 border-gray-200 w-[150px]">Do</th>
                    <th class="p-4 border-2 border-gray-200 w-[150px]">Výsledek</th>
                    <th class="p-4 border-2 border-gray-200 w-[150px]">Body po kole</th>
                </tr>
                <tr>
                    <td class="border-2 border-gray-200 p-4">1.</td>
                    <td class="border-2 border-gray-200 p-4">2.10.2024</td>
                    <td class="border-2 border-gray-200 p-4">8.10.2024</td>
                    <td class="border-2 border-gray-200 p-4">110</td>
                    <td class="border-2 border-gray-200 p-4">110</td>
                </tr>
            </table>
        </div>

        <h2 class="text-xl font-bold mt-12">Všechny ročníky</h2>

        <div class="mt-12 grid grid-cols-3 gap-y-12">
            <div class="bg-brand text-white text-center p-4 space-y-4 max-w-[300px] rounded-md shadow-lg">
                <p class="text-xl font-bold">Ročník 2024</p>
                <x-web.button class="!border-none" type="white">Zobrazit</x-web.button>
            </div>
            <div class="bg-brand text-white text-center p-4 space-y-4 max-w-[300px] rounded-md shadow-lg">
                <p class="text-xl font-bold">Ročník 2023</p>
                <x-web.button class="!border-none" type="white">Zobrazit</x-web.button>
            </div>
            <div class="bg-brand text-white text-center p-4 space-y-4 max-w-[300px] rounded-md shadow-lg">
                <p class="text-xl font-bold">Ročník 2022</p>
                <x-web.button class="!border-none" type="white">Zobrazit</x-web.button>
            </div>
            <div class="bg-brand text-white text-center p-4 space-y-4 max-w-[300px] rounded-md shadow-lg">
                <p class="text-xl font-bold">Ročník 2021</p>
                <x-web.button class="!border-none" type="white">Zobrazit</x-web.button>
            </div>
        </div>
    </x-web.layouts.dashboard>
</x-web.layouts.app>
