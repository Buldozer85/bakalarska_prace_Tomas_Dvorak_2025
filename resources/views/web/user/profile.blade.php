<x-web.layouts.app title="Profil">
    <x-web.layouts.dashboard>
        <div class="flex justify-center md:justify-between items-center">
            <h1 class="text-2xl md:text-3xl text-black font-bold border-b-4 border-brand-darker text-center mt-4 mx-4 max-w-[400px]">{{ $today->day . '. ' . monthInInflection($today->month - 1)  . ' '. $today->year}}</h1>
            <x-web.button class="max-md:hidden" :route="route('homepage')">Zpět na web</x-web.button>
        </div>

        <div class="lg:mt-20 max-w-7xl space-y-16 flex flex-col md:flex-row justify-center md:justify-between ">
            <div class="space-y-12 max-md:mt-12">
                <div class="max-w-3xl flex flex-row items-baseline max-md:justify-center">
                    <h2 class="text-black font-bold text-2xl ">Nadcházející rezervace </h2>
                    <span class="bg-black rounded-full text-white text-lg ml-6 w-6 h-6 leading-6 block text-center">{{ $reservationCount }}</span>
                </div>

                <div>
                    <table class="w-full md:w-[550px] xl:w-[650px] drop-shadow-lg border-gray-400 border">
                        @foreach($upcomingReservations as $reservation)
                            <tr class="border-b-2 border-gray-400">
                                <td class="p-4 font-bold">{{ $reservation->date->format('j.') }} {{ monthInInflection($reservation->date->month - 1) }} {{ $reservation->date->format('Y') }}</td>
                                <td class="p-4">{{ $reservation->from_to }}</td>
                                <td class="p-4">
                                    <x-web.reservation-badge :status="$reservation->status"/>


                                </td>
                                <td class="p-4">
                                    <a href="{{ route('profile.my-reservations.my-reservation', $reservation->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 hover:text-brand">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </a>

                                </td>
                            </tr>
                        @endforeach



                    </table>
                </div>
            </div>


            <div class="max-md:order-first">
                <livewire:web.simple-calendar :reservations="$upcomingReservations"></livewire:web.simple-calendar>
            </div>

        </div>


    </x-web.layouts.dashboard>
</x-web.layouts.app>
