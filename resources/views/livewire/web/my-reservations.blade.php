<div class="mt-12 space-y-8">
    <div class="flex flex-row gap-x-5 justify-start max-w-[300px]">
        <button class="flex-1">Seřadit</button>
        <button class="flex-1">Datum</button>
        <button class="flex-1">Status</button>
    </div>

    <div>
        {{--TODO: Zde budou vypsané vybrané filtry--}}
    </div>
    <div class="shadow-lg space-y-8">
        <div id="accordion-collapse" data-accordion="collapse">
        @foreach($reservations as $reservation)

                <h2 id="accordion-collapse-heading-{{ $reservation->id  }}">
                    <button wire:click="selectedReservationId = {{ $reservation->id }}" type="button"
                            class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                            data-accordion-target="#accordion-collapse-body-{{ $reservation->id }}" aria-expanded="true"
                            aria-controls="accordion-collapse-body-{{ $reservation->id }}">
                    <span class="flex items-center space-x-4"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                   viewBox="0 0 24 24" stroke-width="1.5"
                                                                   stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round"
        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
</svg>
 <time class="font-bold">{{ $reservation->date->format('j. n. Y') }}</time></span>
                        <span class="flex flex-row space-x-4 font-bold">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                              stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                        <time class="font-bold">
                                     {{ $reservation->from_to }}
                        </time>

                    </span>

                        <x-web.reservation-badge :status="$reservation->status"/>


                        <span class="text-gray-400 font-bold">Vytvořena: {{ $reservation->created_at->format('j. n. Y') }}</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0 font-bold" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-collapse-body-{{ $reservation->id }}" class="hidden" aria-labelledby="accordion-collapse-heading-{{ $reservation->id }}">
                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900 space-y-4">
                        <div class="flex flex-col space-y-4">
                            <div class="flex flex-row items-center">
                                <p class="flex-1"><span class="font-bold">Jméno:</span> {{ $reservation->customerInformation->first_name }}</p>
                                <p class="flex-1"><span class="font-bold">Příjmení:</span> {{ $reservation->customerInformation->last_name }}</p>
                                <p class="flex-1"><span class="font-bold">Telefon:</span> {{ $reservation->customerInformation->phone }}</p>
                                <p class="flex-1"><span class="font-bold">E-mail:</span> {{ $reservation->customerInformation->email }}</p>
                            </div>

                            <div class="flex flex-row items-center">
                                <p class="flex-1"><span class="font-bold">Datum:</span> {{ $reservation->date->format('j. n. Y') }}</p>
                                <p class="flex-1"><span class="font-bold">Od:</span> {{ $reservation->slot_from->format('G:i') }}</p>
                                <p class="flex-1"><span class="font-bold">Do:</span> {{ $reservation->slot_to->copy()->addHour()->format('G.i') }}</p>
                                <p class="flex-1"><span class="font-bold">Typ:</span> {{ $reservation->type->label() }}</p>
                            </div>
                        </div>

                        <div class="flex justify-end gap-x-8">
                            <x-web.button>Upravit</x-web.button>
                            <x-web.button type="danger" data-modal-target="deleteReservation"
                                          data-modal-toggle="deleteReservation">Zrušit
                            </x-web.button>
                        </div>
                    </div>
                </div>

        @endforeach
        </div>

    </div>
    {{ $reservations->links() }}
    @script
    <script>
        $wire.on('page-updated', ()=> {
            setTimeout( function () {
                initFlowbiteAccordion();

            }, 50)
        } );

        function initFlowbiteAccordion() {
            const accordionContainers = document.querySelectorAll('[data-accordion="collapse"]');

            accordionContainers.forEach((accordionContainer) => {
                const accordionItems = [];

                accordionContainer.querySelectorAll('button[data-accordion-target]').forEach((button) => {
                    const targetId = button.getAttribute('data-accordion-target');
                    const targetEl = accordionContainer.querySelector(targetId);

                    if (targetEl) {
                        accordionItems.push({
                            id: button.getAttribute('id'),
                            triggerEl: button,
                            targetEl: targetEl,
                            active: targetEl.classList.contains('open'),
                        });
                    }
                });

                if (accordionItems.length > 0) {
                    new Accordion(accordionContainers,accordionItems, {
                        alwaysOpen: accordionContainer.getAttribute('data-accordion-always-open') === 'true',
                        activeClasses: 'bg-gray-100 text-gray-900',
                        inactiveClasses: 'text-gray-500',
                    });
                }
            });
        }
    </script>

    @endscript


</div>
