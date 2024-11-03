<div class="flex-1 flex justify-end" x-data="{
    selectedDate: '{{$selectDate->format('j.n.Y')}}',
    setDatePicker(date) {
        this.selectedDate = date
        $wire.setDate(date)
       document.querySelector('#datepicker').innerText = date
       $dispatch('dateSelected', {date: date})
    },
    resetDatePicker() {
        const date = '{{ \Carbon\Carbon::now()->format('j.n.Y') }}'
        this.selectedDate = date
        $wire.resetDate()
        document.querySelector('#datepicker').innerText = date
       $dispatch('dateSelected', {date: date})
    },
    openedPicker: false
}">
    <div class="relative max-w-sm cursor-pointer" @click="openedPicker = !openedPicker">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-3 h-3 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                 viewBox="0 0 20 20">
                <path
                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
            </svg>
        </div>

        <div id="datepicker"
             class="bg-brand-black border border-gray-300 text-white text-sm rounded-lg block w-full ps-10 p-2.5"
             x-text="selectedDate"></div>
    </div>



    <div class="space-y-2 text-xl bg-brand-black rounded-lg max-w-[350px] p-8 text-white absolute top-[50px]"
         x-show="openedPicker" @click.away="openedPicker = false">
        <div class="flex flex-row justify-between font-bold w-full mx-auto">
            @if(!$this->pastMonth($this->date->copy()->subMonth(), \Carbon\Carbon::now()))
                <svg wire:click="decreaseMonth" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor" class="size-6 cursor-pointer flex-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
                </svg>
            @else
                <div class="flex-1"></div>
            @endif
            <p>{{ $this->label() }}</p>

            <svg wire:click="addMonth" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor" class="size-6 cursor-pointer flex-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
            </svg>
        </div>

        <table class="w-full text-center">
            <tr>
                <th class="px-1">PO</th>
                <th class="px-1">ÚT</th>
                <th class="px-1">ST</th>
                <th class="px-1">ČT</th>
                <th class="px-1">PÁ</th>
                <th class="px-1">SO</th>
                <th class="px-1">NE</th>
            </tr>

            @for($j = 0; $j < 6; $j++)
                <tr>
                    @for($i = 0; $i < 7; $i++)
                        @if(inPast($this->firstDayOfCalendar->copy()->setTime(0,0), \Carbon\Carbon::now()->setTime(0,0)))
                        <td disabled class="cursor-default text-gray-400">{{ $this->printDay()  }}</td>
                        @else
                        <td x-bind:class="selectedDate == '{{ $this->getFormattedDate() }}' ? 'bg-white text-brand-black rounded-full' : '' "
                            class="cursor-pointer"
                            @click="setDatePicker( '{{ $this->getFormattedDate() }}')">{{ $this->printDay()  }}</td>
                        @endif
                    @endfor
                </tr>
            @endfor

        </table>
        <x-web.button class="w-full !border-0" @click.prevent="resetDatePicker" type="white">Resetovat</x-web.button>

    </div>
</div>
