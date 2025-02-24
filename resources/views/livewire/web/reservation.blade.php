<div>
    <div class="relative overflow-x-auto space-y-4 overflow-hidden max-lg:hidden">
        <div class="flex items-center justify-between gap-x-4">
            @if(!is_null(user()) && user()->hasVerifiedEmail() && $showCreateButton)
                <x-web.button :route="route('reservation.show-create')" class="!text-lg flex-1" type="yellow">Vytvořit
                    rezervaci
                </x-web.button>
            @endif

            @guest
                <div class="flex-1"></div>
            @endguest

            <div class=" flex flex-row justify-center gap-x-12 font-bold flex-[2]">
                @if(!inPast($this->firstDayOfWeek, $this->currentWeekFirstDay))
                    <svg wire:click="decreaseWeek" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor" class="size-6 cursor-pointer">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18"/>
                    </svg>
                @endif
                <p>{{ $firstDayOfWeek->format('j.n.Y') }} - {{ $lastDayOfWeek->format('j.n.Y') }}</p>

                <svg wire:click="increaseWeek" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor" class="size-6 cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"/>
                </svg>

            </div>

            <div class="max-w-[250px] flex-1">
                <livewire:web.date-picker :select-date="$selectedDay"/>
            </div>


        </div>

        <table
            class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 overflow-hidden rounded-md">
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

            @for($j = 0; $j <= $interval; $j++)
                @php
                    $date1 = $firstDayOfWeek->copy();
                    $time->setDateFrom($date1)
                @endphp
                <tr class="bg-white border">
                    @for($i = 0; $i <= 7; $i++)
                        @if($i === 0)
                            <td class="px-6 py-4 border text-center font-bold text-brand-black">
                                {{ $time->format('H:i') }}
                            </td>

                        @else
                            <x-web.reservation.tablecell
                                :type="$this->getTimeSlotStatus($time)"
                                read-only
                                id="{{ $time->format('d-n-Y-H-i') }}-cell"/>
                            @php
                                $date1->addDay();
                                $time->setDateFrom($date1)
                            @endphp
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


    <div class="max-w-[350px] mx-auto lg:hidden ">
        <div class="relative overflow-x-auto space-y-4 overflow-hidden mx-6">
            <div class="flex flex-col justify-center space-y-4">
                <div class=" flex flex-row justify-center space-x-12 font-bold flex-1">
                    @if(!inPast($selectedDay->copy()->subDay()->setTime(0,0), now()->setTime(0,0)))
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

                <livewire:web.date-picker :select-date="$selectedDay"/>
                @if(!is_null(user()) && user()->hasVerifiedEmail() && $showCreateButton)
                    <x-web.button :route="route('reservation.show-create')" class="!text-lg flex-1" type="yellow">Vytvořit
                        rezervaci
                    </x-web.button>
                @endif
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
                    $start = openingStart();
                    $end = openingEnd();

                    $interval = abs($end - $start) - 1;

                    $time = \Carbon\Carbon::now()->setTime($start, 0);
                    $timeEnd = $time->copy()->addHours($interval);

                @endphp
                @for($j = 0; $j <= $interval; $j++)
                    <tr class="bg-white border">
                        @for($i = 0; $i <= 1; $i++)
                            @if($i === 0)
                                <td class="px-6 py-4 border text-center font-bold text-brand-black">
                                    {{ $time->format('H:i') }}
                                </td>
                            @else
                                <x-web.reservation.tablecell tool-tip-activation="click" :type="$this->getTimeSlotStatus($time)" :read-only="$readOnly" id="{{ $time->format('d-m-Y-G-i') }}-cell"/>
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

    @script
    <script>
        $wire.on('date-changed', ()=> {
            setTimeout( function () {
                initFlowbiteTooltips();
            }, 50)
        } );

        function initFlowbiteTooltips() {
            document.querySelectorAll('[data-tooltip-target]').forEach((tooltipEl) => {
                const targetId = tooltipEl.getAttribute('data-tooltip-target');
                const targetEl = document.getElementById(targetId);

                if (targetEl) {
                    const t = new Tooltip(targetEl, tooltipEl);
                }
            });
        }
    </script>

    @endscript
</div>
