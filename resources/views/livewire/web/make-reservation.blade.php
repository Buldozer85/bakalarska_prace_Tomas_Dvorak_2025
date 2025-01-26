<div class="max-w-nav 2xl:mx-auto space-y-12 mx-8 pb-12" >

    <div class="flex lg:flex-row flex-col gap-x-4 max-w-[1200px] mx-auto justify-center mt-12 space-y-4">
        <x-web.stepper.step :selected="$this->getSelectedStep() === 1" wire:click="setSelectedStep(1)" class="flex-1"
                            label="Výběr časů" number="1"/>

        <x-web.stepper.step :selected="$this->getSelectedStep() === 2" wire:click="setSelectedStep(2)" class="flex-1"
                            label="Osobní údaje" number="2"/>

        <x-web.stepper.step :selected="$this->getSelectedStep() === 3" wire:click="setSelectedStep(3)" class="flex-1"
                            label="Potvrzení rezervace" number="3"/>
    </div>
    @if($selectedStep !== 1)
        <div class="max-w-nav mx-6">
            <x-web.button class="flex flex-row gap-x-4 items-center" type="black" wire:click="previousStep">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18"/>
                </svg>

                <span>Zpět</span>
            </x-web.button>
        </div>
    @endif

    <div class="flex flex-col lg:flex-row gap-x-12  gap-y-12 mx-6">
        @switch($this->getSelectedStep())
            @case(2)

                <div class="flex-[2] 2xl:flex-[4] shadow-lg p-12 space-y-12">

                    <div class="grid grid-cols-2 gap-4 items-center">
                        <x-web.form.input wire:model.blur="first_name" id="first_name" label="Jméno*" name="first_name"/>
                        <x-web.form.input wire:model.blur="last_name" id="last_name" label="Příjmení*" name="last_name"/>
                        <x-web.form.input wire:model.blur="email" id="email" label="E-mail*" name="email"/>
                        <x-web.form.input wire:model.blur="phone" id="phone" label="Telefon*" name="phone"/>

                        <x-web.form.select wire:model.blur="reservation_type"  :options="\App\Enums\ReservationTypes::select()" name="reservation_type" id="reservation_type" label="Kategorie*"/>
                    </div>

                    <div class="p-[1px] rounded-md bg-gray-200 max-w-[600px] mx-auto"></div>

                    <div class="grid grid-cols-2 gap-4 items-center">
                        <x-web.form.input wire:model="street" name="street" id="street" label="Ulice*"/>
                        <x-web.form.input wire:model="number" name="number" id="number" label="Č.P.*"/>
                        <x-web.form.input wire:model="town" name="town" id="town" label="Město*"/>
                        <x-web.form.input wire:model="postcode" name="postcode" id="postcode" label="PSČ*"/>
                    </div>



                    <x-web.form.check-box wire:model.live="on_company" color="yellow" name="on_company" id="on_company">
                        Rezervuji na firmu
                    </x-web.form.check-box>

                    @if($on_company)
                        <div class="p-[1px] rounded-md bg-gray-200 max-w-[600px] mx-auto"></div>

                        <div class="grid grid-cols-2 gap-4 items-center">
                            <x-web.form.input wire:model.blur="company_name" id="company_name" label="Název firmy"
                                              name="company_name"/>
                            <x-web.form.input wire:model.blur="ico" id="ico" label="IČO" name="ico"/>
                            <x-web.form.input wire:model.blur="company_address" id="company_address" label="Sídlo"
                                              name="company_address"/>
                        </div>
                    @endif

                    <div class="p-[1px] rounded-md bg-gray-200 max-w-[600px] mx-auto"></div>

                    <x-web.form.textarea label="Poznámka" id="note" name="note"
                                         wire:model.blur="note"></x-web.form.textarea>

                </div>

                @break
            @case(3)
                <div class="shadow-lg p-12 max-w-nav flex-[2] mx-auto space-y-6">
                    <h2 class="text-brand-black font-bold text-center text-2xl">Souhrn rezervace</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-4 !mt-12">
                        <x-web.attribute-value label="Jméno">{{ $first_name }}</x-web.attribute-value>
                        <x-web.attribute-value label="E-mail">{{ $email }}</x-web.attribute-value>
                        <x-web.attribute-value label="Telefon">{{ $phone }}</x-web.attribute-value>
                        <x-web.attribute-value label="Typ rezervace">{{ \App\Enums\ReservationTypes::labelByKey($reservation_type) }}</x-web.attribute-value>
                        <x-web.attribute-value label="Na firmu">{{ $on_company ? 'Ano' : 'Ne' }}</x-web.attribute-value>

                    </div>

                 @if($on_company)
                         <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-4 ">
                             <x-web.attribute-value label="Název firmy">{{ $company_name }}</x-web.attribute-value>
                             <x-web.attribute-value label="Sídlo firmy">{{ $company_address }}</x-web.attribute-value>
                             <x-web.attribute-value label="IČO">{{ $ico }}</x-web.attribute-value>
                             <x-web.attribute-value label="Typ rezervace">{{ $reservation_type }}</x-web.attribute-value>
                         </div>
                     @endif

                     <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-4 ">
                         <x-web.attribute-value label="Datum rezervace">{{ $reservation_date->format('j.n.Y') }}</x-web.attribute-value>
                         <x-web.attribute-value label="Začátek rezervace">{{  $reservationTimes->first()->format('G:i') }}</x-web.attribute-value>
                         <x-web.attribute-value label="Konec rezervace">{{ $reservationTimes->last()->copy()->addHour()->format('G:i') }}</x-web.attribute-value>
                     </div>

                    <x-web.attribute-value label="Poznámka">{{ $note }}</x-web.attribute-value>

                    <x-web.form.check-box wire:model.live="credentials_concern" value="1" color="yellow" name="credentials_concern" id="credentials_concent">Potvrzuji
                        správnost svých údajů
                    </x-web.form.check-box>

                </div>
                @break
            @default
                <div class="flex-[2] 2xl:flex-[4] max-lg:hidden">
                    <div>
                        <div class="relative overflow-x-auto space-y-4 overflow-hidden">
                            <div class="flex items-center justify-between gap-x-4">
                                <div class="flex-1"></div>

                                <div class=" flex flex-row justify-center gap-x-12 font-bold flex-[2]">
                                    @if(!inPast($this->firstDayOfWeek, $this->currentWeekFirstDay))
                                        <svg wire:click="decreaseWeek" xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="size-6 cursor-pointer">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18"/>
                                        </svg>
                                    @endif
                                    <p>{{ $firstDayOfWeek->format('j.n.Y') }}
                                        - {{ $lastDayOfWeek->format('j.n.Y') }}</p>

                                    <svg wire:click="increaseWeek" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="size-6 cursor-pointer">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"/>
                                    </svg>

                                </div>

                                <div class="max-w-[250px] flex-1">
                                    <livewire:web.date-picker :select-date="$selectedDay"/>
                                </div>


                            </div>

                            <table
                                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 overflow-hidden rounded-md">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                                    @php
                                        $date1 = $firstDayOfWeek->copy();
                                    $time->setDateFrom($date1)
                                    @endphp
                                    <tr class="bg-white border">
                                        @for($i = 0; $i <= 7; $i++)
                                            @if($i === 0)
                                                {{--                    TODO:bude se resit otviracka, zatim staticky bude start a stop čas    --}}
                                                <td class="px-6 py-4 border text-center font-bold text-brand-black">
                                                    {{ $time->format('H:i') }}
                                                </td>

                                            @else
                                                <x-web.reservation.tablecell
                                                    :type="$this->getTimeSlotStatus($time)"
                                                    wire:click="addTime('{{$time}}')" :read-only="$readOnly"
                                                    id="{{ $ii }}-cell"></x-web.reservation.tablecell>
                                                @php
                                                    $ii++;
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

                    </div>

                </div>

                <div class="lg:hidden">
                    <div class="max-w-[350px] mx-auto lg:hidden ">
                        <div class="relative overflow-x-auto space-y-4 overflow-hidden mx-6">
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

                                <livewire:web.date-picker :select-date="$selectedDay"/>
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
                                    $time = $selectedDay->copy()->setTime(9, 0);
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
                                                <x-web.reservation.tablecell wire:click="addTime('{{$time}}')"
                                                                             tool-tip-activation="click"
                                                                             :type="$this->getTimeSlotStatus($time)"
                                                                             :read-only="$readOnly"
                                                                             id="{{ $time->format('d-m-Y-G-i') }}-cell"/>
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
                </div>
                @break
        @endswitch
            <livewire:web.summary
                @timer-expired="cancelReservation"
                :current-step="$this->getSelectedStep()"
                :expiry="$this->reservationTemporaryEndDate"
                :from="$this->reservationTimes->first()"
                :to="$this->reservationTimes->last()?->copy()->addHour()"
                :date="$this->reservation_date"/>

            @if(session()->has('flashMessage'))
                <x-web.toast :type="session('flashMessage')['type']" :message="session('flashMessage')['message']"/>
            @endif

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
