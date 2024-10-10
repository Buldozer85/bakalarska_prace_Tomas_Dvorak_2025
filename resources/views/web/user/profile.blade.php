@php
    $today = \Carbon\Carbon::now();
    $count = 0; //TODO: Delete after connecting values from db
@endphp
<x-web.layouts.app title="Profil">
    <x-web.layouts.dashboard>
        <h1 class="text-3xl text-black font-bold border-b-4 border-brand-darker text-center mt-4 mx-4 max-w-[200px]">{{ $today->day . '. ' . monthInInflection($today->month - 1)  . ' '. $today->year}}</h1>
        <div class=" max-w-7xl  mt-20 space-y-8 flex flex-row justify-between">
            <div class="space-y-4">
                <div class="max-w-3xl flex flex-row items-baseline">
                    <h2 class="text-black font-bold text-2xl">Nadcházející rezervace </h2>
                    <span class="bg-black rounded-full text-white text-lg ml-6 w-6 h-6 leading-6 block text-center">{{ $count }}</span>
                </div>

                <div class="flex flex-row items-center space-x-4">
                    <div class="flex flex-row items-center">
                        <span class="w-4 h-4 bg-green-600"></span>
                        <p class="ml-2 font-bold">
                            Potvrzená
                        </p>
                    </div>

                    <div class="flex flex-row items-center">
                        <span class="w-4 h-4 bg-yellow-500"></span>
                        <p class="ml-2 font-bold">
                            Čeká na vyřízení
                        </p>
                    </div>

                    <div class="flex flex-row items-center">
                        <span class="w-4 h-4 bg-red-600"></span>
                        <p class="ml-2 font-bold">
                            Zrušená
                        </p>
                    </div>
                </div>

                <div>
                    <table class="w-[450px] drop-shadow-lg border-black border-2">
                        <tr class="bg-green-600 text-white border-b-2 border-black">
                            <td class="p-4">7. {{ monthInInflection(9) }} 2024</td>
                            <td class="p-4">9:00 - 10:00</td>
                            <td class="p-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            </td>
                            <td class="p-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </td>
                        </tr>

                        <tr class="bg-yellow-500 text-white border-b-2 border-black">
                            <td class="p-4">7. {{ monthInInflection(9) }} 2024</td>
                            <td class="p-4">9:00 - 10:00</td>
                            <td class="p-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            </td>
                            <td class="p-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </td>
                        </tr>

                        <tr class="bg-red-600 text-white">
                            <td class="p-4">7. {{ monthInInflection(9) }} 2024</td>
                            <td class="p-4">9:00 - 10:00</td>
                            <td class="p-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            </td>
                            <td class="p-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>


            <livewire:web.simple-calendar></livewire:web.simple-calendar>
        </div>


    </x-web.layouts.dashboard>
</x-web.layouts.app>
