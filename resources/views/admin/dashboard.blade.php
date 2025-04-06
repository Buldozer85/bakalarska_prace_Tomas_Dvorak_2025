<x-admin.layouts.app title="Dashboard" page="dashboard">
    <div class=" xl:mx-auto max-w-[1400px] space-y-4 mx-6">
    <div class="flex flex-row items-baseline max-md:justify-center">
        <h2 class="text-black font-bold text-2xl ">Nevyřízené nové rezervace</h2>
        <span class="bg-brand-reserved rounded-full text-white text-lg ml-6 w-6 h-6 leading-6 block text-center">{{ $count }}</span>
    </div>

    <div class="max-w-[1400px] mx-auto">
        <table class="w-full max-w-[1000px] border-gray-200 border overflow-auto">
            @foreach($reservations as $reservation)
                <tr class="border-b-2 border-gray-200">
                    <td class="p-4 min-w-[200px]"><span class="text-brand-reserved">Vytvořena:</span>&nbsp;{{ $reservation->created_at->format('j.') }}&nbsp;{{ $reservation->created_at->format('n.') }}&nbsp;{{ $reservation->created_at->format('Y') }}</td>
                    <td class="p-4 min-w-[200px]">{{ $reservation->user->email }}</td>
                    <td class="p-4 min-w-[250px]">{{ $reservation->date->format('j.n.Y') }},&nbsp;{{ $reservation->slot_from->format('G:i') }}&nbsp;-&nbsp;{{ $reservation->slot_to->format('G:i') }}</td>
                    <td class="p-4 min-w-[200px] text-center">
                        <x-web.reservation-badge :status="$reservation->status"/>
                    </td>
                    <td class="p-4">
                        <a href="{{ route('administration.reservation.detail', $reservation->id) }}">
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

    <div class="flex flex-row items-center  gap-x-1">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
        </svg>

        <span class="text-brand-reserved text-2xl block text-center font-bold">{{ $messages->count() }}</span>
        <h2 class="text-black font-bold text-2xl "> Nové zprávy</h2>

    </div>

    <div class="max-w-[1400px] mx-auto">
        <table class="w-full max-w-[1000px] border-gray-200 border overflow-auto">
            @foreach($messages as $message)
                <tr class="border-b-2 border-gray-200">
                    <td class="p-4"><span class="text-brand">Přijata:</span>&nbsp;{{ $message->sent->format('j.') }}&nbsp;{{ monthInInflection($message->sent->month - 1) }}&nbsp;{{ $message->sent->format('Y') }}</td>
                    <td class="p-4">Od:&nbsp;{{ $message->sender_email }}</td>
                    <td class="p-4 font-bold">{{ Str::limit($message->message, 20) }}</td>

                    <td class="p-4">
                        <a href="{{ route('administration.conversations.detail', $message->conversation->id) }}">
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
</x-admin.layouts.app>
