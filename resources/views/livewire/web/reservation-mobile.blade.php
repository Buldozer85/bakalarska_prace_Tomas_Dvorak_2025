<div class="max-w-[350px] mx-auto">
    <div class="relative overflow-x-auto space-y-4 overflow-hidden">
        <div class="flex flex-col justify-center space-y-4">
            <div class=" flex flex-row justify-center space-x-12 font-bold flex-1">
                @if(!inPast($selectedDay->copy()->subDay()->setTime(0,0), \Carbon\Carbon::now()->setTime(0,0)))
                    <svg wire:click="subDay" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 cursor-pointer">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                    </svg>
                @else
                    <div></div>
                @endif
                <p>{{ daysOfWeek($selectedDay->dayOfWeekIso - 1) }} - {{ $selectedDay->format('j.n.Y') }}</p>

                <svg wire:click="addDay" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                </svg>

            </div>

            <livewire:web.date-picker/>
        </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 overflow-hidden rounded-md lg:hidden">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3 border">

            </th>

            <th scope="col" class="px-6 py-3 text-center font-bold text-brand-black border">
                {{ daysOfWeek($selectedDay->dayOfWeekIso - 1) }} - {{ $selectedDay->format('j.n.Y') }}
            </th>
        </tr>
        </thead>
        <tbody>
        @php
            $time = \Carbon\Carbon::now()->setTime(9, 0);
            $timeEnd = $time->copy()->addHours(9);

            $interval = abs($timeEnd->hour - $time->hour);

        @endphp
        @for($j = 0; $j <= $interval; $j++)
            <tr class="bg-white border">
                @for($i = 0; $i <= 1; $i++)
                    @if($i === 0)
                        {{--                    TODO:bude se resit otviracka, zatim staticky bude start a stop čas    --}}
                        <td class="px-6 py-4 border text-center font-bold text-brand-black font-bold">
                            {{ $time->format('H:i') }}
                        </td>
                    @else
                        <x-web.reservation.tablecell :type="$this->getTimeSlotStatus($time)" :read-only="$readOnly" id="{{ $time->format('d-m-Y-G-i') }}-cell"/>
                    @endif

                @endfor
            </tr>
            @php
                $time->addHour()
            @endphp
        @endfor
        </tbody>
    </table>
    </div>
</div>
