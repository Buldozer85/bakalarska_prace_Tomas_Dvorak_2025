<div>
    <div class="relative overflow-x-auto space-y-4 overflow-hidden">
        <div class="flex items-center justify-end">

            <div class=" flex flex-row justify-end space-x-12 font-bold flex-[2]">
                @if(!inPast($this->firstDayOfWeek, $this->currentWeekFirstDay))
                <svg wire:click="decreaseWeek" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                </svg>
                @endif
                <p>{{ $firstDayOfWeek->format('j.n.Y') }} - {{ $lastDayOfWeek->format('j.n.Y') }}</p>

                <svg wire:click="increaseWeek" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                </svg>

            </div>

            <livewire:web.date-picker/>
        </div>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 overflow-hidden rounded-md">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 border">

                </th>
                @php
                    $date = $firstDayOfWeek->copy();
                @endphp
                @foreach(['PO', 'ÚT', 'ST', 'ČT', 'PÁ', 'SO', 'NE'] as $dayOfWeek)
                    <th scope="col" class="px-6 py-3 text-center font-bold text-brand-black border">
                        {{ $dayOfWeek  }} - {{ $date->format('j. n.') }}
                    </th>

                    @php
                        $date->addDay();
                    @endphp
                @endforeach
            </tr>
            </thead>
            <tbody>
            @php
                $time = \Carbon\Carbon::now()->setTime(9, 0);
                $timeEnd = $time->copy()->addHours(9);

                $interval = abs($timeEnd->hour - $time->hour);

                $ii = 0; /* Smazat bude nejake id */

            @endphp
            @for($j = 0; $j <= $interval; $j++)
            <tr class="bg-white border">
                    @for($i = 0; $i <= 7; $i++)
                        @if($i === 0)
                            {{--                    TODO:bude se resit otviracka, zatim staticky bude start a stop čas    --}}
                            <td class="px-6 py-4 border text-center font-bold text-brand-black">
                                {{ $time->format('H:i') }}
                            </td>

                            @php
                                $time->addHour()
                            @endphp
                        @else
                            <x-web.reservation.tablecell :read-only="$readOnly" id="{{ $ii }}-cell"/>
                            @php
                                $ii++;
                            @endphp
                        @endif
                    @endfor
            </tr>
            @endfor
            </tbody>
        </table>
    </div>

</div>
