<div class="mt-12 space-y-8" x-data="{
    deleteReservation() {
        $wire.deleteReservation()
    }
}">
    <div class="flex flex-row gap-x-5 justify-start max-w-[300px]">
        <button class="flex-1">Seřadit</button>
        <button class="flex-1">Datum</button>
        <button class="flex-1">Status</button>
    </div>

    <div>
        {{--TODO: Zde budou vypsané vybrané filtry--}}
    </div>
    <div class="shadow-lg space-y-8">

        <div id="accordion-open" data-accordion="open">
            <h2 id="accordion-open-heading-1">
                {{--TODO: Set right id when looping reservations--}}
                <button wire:click="selectedReservationId = 1" type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-open-body-1" aria-expanded="true" aria-controls="accordion-open-body-1">
                    <span class="flex items-center space-x-4"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
</svg>
 <time class="font-bold">7. 10. 2024</time></span>
                    <span class="flex flex-row space-x-4 font-bold">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                        <time class="font-bold">
                                     9:00 - 10:00
                        </time>

                    </span>

                    <span class="text-green-500 font-bold">Potvrzeno</span>


                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0 font-bold" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                    </svg>
                </button>
            </h2>
            <div id="accordion-open-body-1" class="hidden" aria-labelledby="accordion-open-heading-1">
                <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900 space-y-4">
                        <div class="flex flex-col space-y-4">
                            <div class="flex flex-row items-center">
                                <p class="flex-1"><span class="font-bold">Jméno:</span> John</p>
                                <p class="flex-1"> <span class="font-bold">Příjmení:</span> Doe</p>
                                <p class="flex-1"><span class="font-bold">Telefon:</span> 777 777 777</p>
                                <p class="flex-1"><span class="font-bold">E-mail:</span> john@doe.cz</p>
                            </div>

                            <div class="flex flex-row items-center">
                                <p class="flex-1"><span class="font-bold">Datum:</span> 7.10.2024</p>
                                <p class="flex-1"> <span class="font-bold">Od:</span> 9:00</p>
                                <p class="flex-1"><span class="font-bold">Do:</span> 10:00</p>
                                <p class="flex-1"><span class="font-bold">Typ:</span> Rezervace dráhy č.1</p>
                            </div>
                        </div>

                    <div class="flex justify-end gap-x-8">
                        <x-web.button>Upravit</x-web.button>
                        <x-web.button type="danger" data-modal-target="deleteReservation" data-modal-toggle="deleteReservation">Zrušit</x-web.button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <x-web.confirm-action-modal action="deleteReservation" id="deleteReservation" text="Opravdu si přejete zrušit rezervaci?"/>
</div>
