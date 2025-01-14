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
        <div class="max-w-nav">
            <x-web.button class="flex flex-row gap-x-4 items-center" type="black" wire:click="previousStep">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18"/>
                </svg>

                <span>Zpět</span>
            </x-web.button>
        </div>
    @endif

    <div class="flex flex-col lg:flex-row gap-x-12 max-xl:space-y-12">
        @switch($this->getSelectedStep())
            @case(2)

                <div class="flex-[2] 2xl:flex-[4] shadow-lg p-12 space-y-12">

                    <div class="grid grid-cols-2 gap-4 items-center">
                        <x-web.form.input wire:model.blur="first_name" id="first_name" label="Jméno" name="first_name"/>
                        <x-web.form.input wire:model.blur="last_name" id="last_name" label="Příjmení" name="last_name"/>
                        <x-web.form.input wire:model.blur="email" id="email" label="E-mail" name="email"/>
                        <x-web.form.input wire:model.blur="phone" id="phone" label="Telefon" name="phone"/>

                        <select>
                            <option>ZDe budou kat</option>
                        </select>
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
                <x-web.reservations.summary/>
                @break
            @case(3)
                <div class="shadow-lg p-12 max-w-nav flex-1 mx-auto space-y-12">
                    <h2 class="text-brand-black font-bold text-center text-2xl">Souhrn rezervace</h2>
                    <div class="grid grid-cols-3 space-y-4">
                        <x-web.attribute-value label="Jméno">John Doe</x-web.attribute-value>
                        <x-web.attribute-value label="E-mail">hh@hh.cz</x-web.attribute-value>
                        <x-web.attribute-value label="Telefon">777666555</x-web.attribute-value>
                        <x-web.attribute-value label="Typ rezervace">Komerční</x-web.attribute-value>
                        <x-web.attribute-value label="Na firmu">Ne</x-web.attribute-value>

                    </div>
                    {{-- <div class="grid grid-cols-3">
                         <x-web.attribute-value label="Jméno">{{ /**/ }}</x-web.attribute-value>
                         <x-web.attribute-value label="E-mail">{{ $email }}</x-web.attribute-value>
                         <x-web.attribute-value label="Telefon">{{ $phone }}</x-web.attribute-value>
                         <x-web.attribute-value label="Typ rezervace">{{ $reservation_type }}</x-web.attribute-value>
                         <x-web.attribute-value label="Na firmu">{{  }}</x-web.attribute-value>

                     </div>

                 @if($on_company)
                         <div class="grid grid-cols-3">
                             <x-web.attribute-value label="Název firmy">{{ $company_name }}</x-web.attribute-value>
                             <x-web.attribute-value label="Sídlo firmy">{{ $company_address }}</x-web.attribute-value>
                             <x-web.attribute-value label="IČO">{{ $ico }}</x-web.attribute-value>
                             <x-web.attribute-value label="Typ rezervace">{{ $reservation_type }}</x-web.attribute-value>
                             <x-web.attribute-value label="Na firmu">{{  }}</x-web.attribute-value>
                         </div>
                     @endif

                     <div class="grid grid-cols-3">
                         <x-web.attribute-value label="Datum rezervace">{{ $reservation_date->format('j.n.Y') }}</x-web.attribute-value>
                         <x-web.attribute-value label="Začátek rezervace">{{  '' }}</x-web.attribute-value>
                         <x-web.attribute-value label="Konec rezervace">{{ '' }}</x-web.attribute-value>
                     </div>--}}

                    <x-web.attribute-value label="Poznámka">{{ $note }}</x-web.attribute-value>

                    <x-web.form.check-box color="yellow" name="credentials_concent" id="credentials_concent">Potvrzuji
                        správnost svých údajů
                    </x-web.form.check-box>

                    <x-web.button type="yellow">Dokončit</x-web.button>
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
                                    <livewire:web.date-picker/>
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
                                                    :type="($reservationTimes->contains($time)) ? 'selected' : 'empty'"
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
                    <livewire:web.reservation-mobile :read-only="false"/>
                </div>
<livewire:web.summary :expiry="$this->reservationTemporaryEndDate" :from="$this->reservationTimes->first()" :to="$this->reservationTimes->last()->copy()->addHour()" :date="\Carbon\Carbon::now()"/>

                @break
        @endswitch


    </div>

</div>
