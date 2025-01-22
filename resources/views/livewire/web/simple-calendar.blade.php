
<div class="space-y-2 text-xl">
    <div class="flex flex-row justify-between font-bold w-full mx-auto">
        <svg wire:click="decreaseMonth" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 cursor-pointer">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>

        <p>{{ $this->label() }}</p>

        <svg wire:click="addMonth" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 cursor-pointer">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
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
                        <td @if($this->hasDate()) class="rounded-full bg-brand text-white" @endif>{{ $this->printDay()  }}</td>
                    @endfor
                </tr>
            @endfor

        </table>



</div>
