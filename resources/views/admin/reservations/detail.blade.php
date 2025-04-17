<x-admin.layouts.app title="Rezervace" page="reservations">

    <div class="text-sm font-medium text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700 max-w-[1400px] mx-auto space-y-4" x-data="{
            selectedTab: window.location.hash.replace('#', '').length > 0 ? window.location.hash.replace('#', '') : 'general'
        }">

        <div class="2xl:max-w-[200px]">
            <x-admin.button :route="route('administration.reservation.index')" type="black" >
                Zpět
            </x-admin.button>
        </div>

        <div class="flex flex-col md:justify-between gap-y-4">
            <ul class="flex flex-wrap -mb-px flex-[3]">
                <x-admin.tab tab-name="general">Obecné</x-admin.tab>
                <x-admin.tab tab-name="customerInfo">Osobní údaje</x-admin.tab>
                <x-admin.tab tab-name="address">Adresa</x-admin.tab>
                <x-admin.tab tab-name="companyData">Firemní údaje</x-admin.tab>

                <x-admin.tab tab-name="documents">Dokumenty</x-admin.tab>
            </ul>

            @if(!inPast($reservation->date, now()))
                <div class="xl:space-x-4 flex flex-col xl:flex-row gap-y-4 gap-x-4 xl:items-center">
                    <div class="flex-1 w-full">
                        <x-admin.button class="w-full" data-modal-target="cancelReservationModal" data-modal-toggle="cancelReservationModal" type="danger">Zrušit</x-admin.button>
                    </div>

                    @if(is_null($reservation->cancelled))
                        <div class="">
                            @if(is_null($reservation->confirmed))
                                <x-admin.button :route="route('administration.reservation.confirmReservation', $reservation->id)">Potvrdit</x-admin.button>
                            @else
                                <x-admin.button type="yellow" :route="route('administration.reservation.unConfirmReservation', $reservation->id)">Zrušit potvrzení</x-admin.button>
                            @endif
                        </div>
                    @endif
                </div>

                <x-admin.modal id="cancelReservationModal">
                    <div class="flex flex-col justify-center items-center gap-y-6">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-14 text-brand-reserved">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                        </svg>

                        <h3 class="text-xl font-bold">Zrušit rezervaci</h3>

                        <p class="font-normal">Opravdu si přejete zrušit rezervaci?</p>

                        <div class="flex flex-row gap-x-4 w-full">

                            <x-admin.button data-modal-hide="cancelReservationModal" :route="route('administration.reservation.cancelReservation', $reservation->id)" class="flex-1" type="danger">Zrušit</x-admin.button>
                            <x-admin.button data-modal-hide="cancelReservationModal" class="flex-1" type="yellow">Zavřít</x-admin.button>
                        </div>
                    </div>
                </x-admin.modal>
            @endif


        </div>


        <div class="shadow-lg p-8 px-12 space-y-8">
            <div x-show="selectedTab == 'general'" class="flex flex-row gap-x-2">

                <p class="font-bold text-brand-black">Stav: </p>
                <x-web.reservation-badge :status="$reservation->status"/>
            </div>


                <form class="space-y-3 " method="POST" action="{{ route('administration.reservation.update', $reservation->id) }}">
                    @method('PUT')
                    @csrf

                    <div x-show="selectedTab == 'general'" class="flex flex-col justify-start gap-y-4">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 gap-y-4 justify-items-start">
                            <x-admin.attribute-value label="Datum rezervace">{{ $reservation->date->format('j. n. Y') }}</x-admin.attribute-value>
                            <x-admin.attribute-value label="Od - Do">{{ $reservation->slot_from->format('G:i') }} - {{ $reservation->slot_to->copy()->addHour()->format('G:i') }}</x-admin.attribute-value>
                            <div class="flex flex-row gap-x-4 items-center">
                                <label for="reservation_type" class="text-brand-black font-bold">Typ rezervace:</label>
                                <x-admin.form.select :options="\App\Enums\ReservationTypes::select()" :selected="$reservation->type->value" name="reservation_type" id="reservation_type" />
                            </div>

                            <x-admin.form.check-box value="1" :checked="$reservation->on_company"  id="on_company" name="on_company">Na firmu </x-admin.form.check-box>
                        </div>

                        <div class="text-left">
                            <x-admin.form.textarea name="note" id="note" label="Poznámka"> {{ $reservation->note }} </x-admin.form.textarea>
                        </div>
                    </div>

                    <div x-show="selectedTab == 'customerInfo'" class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 gap-y-2">
                        <x-admin.form.input name="first_name" id="first_name" label="Jméno" value="{{ $reservation->customerInformation->first_name }}" />
                        <x-admin.form.input name="last_name" id="last_name" label="Příjmení" value="{{ $reservation->customerInformation->last_name }}" />
                        <x-admin.form.input name="email" id="email" label="E-mail" value="{{ $reservation->customerInformation->email }}" />
                        <x-admin.form.input name="phone" id="phone" label="Telefon" value="{{ $reservation->customerInformation->phone }}" />
                    </div>

                    <div x-show="selectedTab == 'address'" class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 gap-y-2">
                        <x-admin.form.input name="street" id="street" label="Ulice" value="{{ $reservation->address->street }}" />
                        <x-admin.form.input name="number" id="number" label="Č.P." value="{{ $reservation->address->number }}" />
                        <x-admin.form.input name="town" id="town" label="Město" value="{{ $reservation->address->town }}" />
                        <x-admin.form.input name="postcode" id="postcode" label="PSČ" value="{{ $reservation->address->postcode }}" />
                        <x-admin.form.input disabled name="country" id="country" label="Země" value="{{ $reservation->address->country }}" />
                    </div>

                        <div x-show="selectedTab == 'companyData'" class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 gap-y-2">
                            <x-admin.form.input name="company_name" id="company_name" label="Název firmy" value="{{ $reservation->companyData?->company_name }}" />
                            <x-admin.form.input name="ico" id="ico" label="IČO" value="{{ $reservation->companyData?->ICO }}" />
                            <x-admin.form.input name="company_address" id="company_address" label="Sídlo firmy" value="{{ $reservation->companyData?->company_address }}" />
                        </div>



                    <div class="flex justify-end">
                        <x-web.button type="primary" submit display-bg>
                            Uložit
                        </x-web.button>
                    </div>
                </form>
        </div>


    </div>


</x-admin.layouts.app>
