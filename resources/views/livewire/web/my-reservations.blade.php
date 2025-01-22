<div class="mt-12 space-y-8" x-data="{
    reservation: {
        id: ''
    },
    setReservationId() {
        $wire.set('selectedReservationId', this.reservation.id)
    }
 }">
    <div class="flex flex-row gap-x-5 justify-start max-w-[400px]">
        <button id="dropdownOrderByButton"
                data-dropdown-toggle="dropdownOrderBy"
                class="text-white bg-brand-black focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
                type="button">Seřadit <svg class="w-2.5 h-2.5 ms-3"
                                           aria-hidden="true"
                                           xmlns="http://www.w3.org/2000/svg"
                                           fill="none"
                                           viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
        </button>

        <!-- Dropdown menu -->
        <div id="dropdownOrderBy" class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow">
            <ul class="p-3 space-y-3 text-sm text-gray-700" aria-labelledby="dropdownRadioButton">
                <li>
                    <div class="flex items-center">
                        <input wire:model.live="orderBy"
                               id="default-radio-1"
                               type="radio" value="date"
                               name="default-radio"
                               class="w-4 h-4 text-brand-black bg-gray-100 border-gray-300 focus:ring-brand-black">
                        <label for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900">Datum rezervace</label>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <input wire:model.live="orderBy"
                               id="default-radio-2"
                               type="radio"
                               value="created_at"
                               name="default-radio"
                               class="w-4 h-4 text-brand-black bg-gray-100 border-gray-300 focus:ring-brand-black">
                        <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900">Dle vytvoření</label>
                    </div>
                </li>

            </ul>
        </div>


        <button id="dropdownStatusOptionsButton"
                data-dropdown-toggle="dropdownStatusOptions"
                class="text-brand-black bg-brand-yellow focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
                type="button">Status
            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
        </button>
        <!-- Dropdown menu -->
        <div id="dropdownStatusOptions" class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow">
        <ul class="p-3 space-y-3 text-sm text-gray-700" aria-labelledby="dropdownCheckboxButton">
            <li>
                <div class="flex items-center">
                    <input wire:model.live="status"
                           id="status-waiting"
                           type="radio" value="{{ \App\Enums\ReservationStatus::WAITING->value }}"
                           name="default-radio"
                           class="w-4 h-4 text-brand-black bg-gray-100 border-gray-300 focus:ring-brand-black">
                    <label for="status-waiting" class="ms-2 text-sm font-medium text-gray-900">Čeká na vyřízení</label>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <input wire:model.live="status"
                           id="status-confirmed"
                           type="radio"
                           value="{{ \App\Enums\ReservationStatus::CONFIRMED->value }}"
                           name="default-radio"
                           class="w-4 h-4 text-brand-black bg-gray-100 border-gray-300 focus:ring-brand-black">
                    <label for="status-confirmed" class="ms-2 text-sm font-medium text-gray-900">Potvrzená</label>
                </div>
            </li>

            <li>
                <div class="flex items-center">
                    <input wire:model.live="status"
                           id="status-cancelled"
                           type="radio"
                           value="{{ \App\Enums\ReservationStatus::CANCELLED->value }}"
                           name="default-radio"
                           class="w-4 h-4 text-brand-black bg-gray-100 border-gray-300 focus:ring-brand-black">
                    <label for="status-cancelled" class="ms-2 text-sm font-medium text-gray-900">Zrušená</label>
                </div>
            </li>
        </ul>
    </div>

        <x-web.button wire:click="resetFilters" type="danger">Resetovat filtry</x-web.button>
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
                    <span class="flex items-center space-x-4 flex-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor"
                             class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                        </svg>
                        <time class="font-bold">{{ $reservation->date->format('j. n. Y') }}</time>
                    </span>

                        <span class="flex flex-row space-x-4 font-bold flex-1">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor"
                                 class="size-6">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            <time class="font-bold">
                                     {{ $reservation->from_to }}
                            </time>
                        </span>

                        <div class="flex-1">
                            <x-web.reservation-badge :status="$reservation->status"/>
                        </div>

                        @if(is_null($reservation->cancelled))
                            <div class="flex-1">
                                <span class="text-gray-400 font-bold">Vytvořena: {{ $reservation->created_at->format('j. n. Y') }}</span>
                            </div>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0 font-bold flex-1"
                                 aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 10 6">
                                <path stroke="currentColor"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9 5 5 1 1 5"/>
                            </svg>
                        @else
                            <div class="flex-1">
                                <span class="text-red-400 font-bold">Zrušena: {{ $reservation->cancelled->format('j. n. Y') }}</span>
                            </div>

                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0 font-bold flex-1 text-right" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 5 5 1 1 5"/>
                                </svg>


                        @endif

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
                            @if(is_null($reservation->cancelled))
                                <x-web.button :route="route('profile.my-reservations.my-reservation', $reservation->id)">Detail</x-web.button>
                            @endif
                            @if($reservation->can_be_cancelled)
                            <x-web.button type="danger" @click="reservation.id = {{ $reservation->id }};" data-modal-target="deleteReservation"
                                          data-modal-toggle="deleteReservation">Zrušit
                            </x-web.button>
                            @endif
                        </div>
                    </div>
                </div>

        @endforeach
        </div>
        <x-web.confirm-action-modal id="deleteReservation">
            <svg class="mx-auto mb-4 text-black w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>
            <h3 class="mb-5 text-lg font-bold text-black">Opravdu si přejete zrušit rezervaci?</h3>
            <div class="flex justify-between max-w-[250px] gap-x-5 mx-auto">
                <x-web.button class="flex-1" @click="$wire.cancelReservation(reservation.id)" data-modal-hide="deleteReservation" type="danger">Potvrdit</x-web.button>
                <x-web.button class="flex-1" data-modal-hide="deleteReservation" data-modal-hide="deleteReservation" type="white">Zpět</x-web.button>
            </div>

        </x-web.confirm-action-modal>
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
