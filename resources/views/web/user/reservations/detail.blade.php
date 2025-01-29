<x-web.layouts.app page="my-reservations" title="Rezervace #{{ $reservation->id }}">
    <x-web.layouts.dashboard site="moje-rezervace">
        <div class="mx-auto xl:w-[900px] space-y-12" x-data="{
            selectedTab: window.location.hash.replace('#', '').length > 0 ? window.location.hash.replace('#', '') : 'general'
        }">
            <h1 class="text-3xl text-black font-bold border-b-4 border-brand-darker text-center mt-4 mx-4 max-w-[300px] pb-2">Moje rezervace #{{ $reservation->id }}</h1>

            <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px">
                    <x-web.tab tab-name="general">Obecné</x-web.tab>
                    <x-web.tab tab-name="customerInfo">Osobní údaje</x-web.tab>
                    <x-web.tab tab-name="address">Adresa</x-web.tab>
                    <x-web.tab :disabled="!$reservation->on_company" tab-name="companyData">Firemní údaje</x-web.tab>

                    <x-web.tab :disabled="is_null($reservation->documents->first())" tab-name="documents">Dokumenty</x-web.tab>
                </ul>


            </div>
            <div class="mt-6 flex justify-between">
                <x-web.button :route="route('profile.my-reservations')" type="yellow">Zpět</x-web.button>
                <x-web.button data-modal-target="cancelReservation" data-modal-toggle="cancelReservation" type="danger">Zrušit</x-web.button>
            </div>

            <div class="shadow-lg p-8 px-12 space-y-8">
                <div x-show="selectedTab == 'general'" class="flex flex-row gap-x-2">
                    <p class="font-bold text-brand-black">Stav: </p>
                    <x-web.reservation-badge :status="$reservation->status"/>
                </div>

                <div x-show="selectedTab == 'general'" class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 gap-y-4">
                    <x-web.attribute-value label="Datum rezervace">{{ $reservation->date->format('j. n. Y') }}</x-web.attribute-value>
                    <x-web.attribute-value label="Od - Do">{{ $reservation->slot_from->format('G:i') }} - {{ $reservation->slot_to->copy()->addHour()->format('G:i') }}</x-web.attribute-value>
                    <x-web.attribute-value label="Typ rezervace">{{ $reservation->type->label() }}</x-web.attribute-value>
                    <x-web.attribute-value label="Na firmu">{{ $reservation->on_company_label }}</x-web.attribute-value>
                    <x-web.attribute-value label="Poznámka">{{ $reservation->note }}</x-web.attribute-value>

                </div>

                @if($reservation->status['key'] != \App\Enums\ReservationStatus::CONFIRMED->value)
                    <form class="space-y-3 " method="POST" action="{{ route('profile.my-reservations.my-reservation.update', $reservation->id) }}">
                        @method('PUT')
                        @csrf
                        <div x-show="selectedTab == 'customerInfo'" class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 gap-y-2">
                            <x-web.form.input name="first_name" id="first_name" label="Jméno" value="{{ $reservation->customerInformation->first_name }}" />
                            <x-web.form.input name="last_name" id="last_name" label="Příjmení" value="{{ $reservation->customerInformation->last_name }}" />
                            <x-web.form.input name="email" id="email" label="E-mail" value="{{ $reservation->customerInformation->email }}" />
                            <x-web.form.input name="phone" id="phone" label="Telefon" value="{{ $reservation->customerInformation->phone }}" />
                        </div>

                        <div x-show="selectedTab == 'address'" class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 gap-y-2">
                            <x-web.form.input name="street" id="street" label="Ulice" value="{{ $reservation->address->street }}" />
                            <x-web.form.input name="number" id="number" label="Č.P." value="{{ $reservation->address->number }}" />
                            <x-web.form.input name="town" id="town" label="Město" value="{{ $reservation->address->town }}" />
                            <x-web.form.input name="postcode" id="postcode" label="PSČ" value="{{ $reservation->address->postcode }}" />
                            <x-web.form.input disabled name="country" id="country" label="Země" value="{{ $reservation->address->country }}" />
                        </div>

                        @if($reservation->on_company)
                            <div x-show="selectedTab == 'companyData'" class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 gap-y-2">
                                <x-web.form.input name="company_name" id="company_name" label="Název firmy" value="{{ $reservation->companyData->company_name }}" />
                                <x-web.form.input name="ico" id="ico" label="IČO" value="{{ $reservation->companyData->ICO }}" />
                                <x-web.form.input name="company_address" id="company_address" label="Sídlo firmy" value="{{ $reservation->companyData->company_address }}" />
                            </div>
                        @endif


                        <div x-show="selectedTab != 'general'" class="flex justify-end">
                            <x-web.button type="primary" submit display-bg>
                                Uložit
                            </x-web.button>
                        </div>
                    </form>
                @else
                    <div x-show="selectedTab == 'customerInfo'" class="flex flex-col md:grid grid-cols-2 mx-auto gap-x-8 xl:gap-x-32 gap-y-4 px-6">
                        <x-web.attribute-value label="Jméno">{{ $reservation->customerInformation->first_name }}</x-web.attribute-value>
                        <x-web.attribute-value label="Příjmení">{{ $reservation->customerInformation->last_name }}</x-web.attribute-value>
                        <x-web.attribute-value label="E-mail">{{ $reservation->customerInformation->email }}</x-web.attribute-value>
                        <x-web.attribute-value label="Telefon">{{ $reservation->customerInformation->phone }}</x-web.attribute-value>
                    </div>

                    @if($reservation->on_company)
                        <div x-show="selectedTab == 'companyData'" class="flex flex-col md:grid grid-cols-2 mx-auto gap-x-8 xl:gap-x-32 gap-y-4 px-6">
                            <x-web.attribute-value label="Název firmy">{{ $reservation->companyData->copany_name }}</x-web.attribute-value>
                            <x-web.attribute-value label="Sídlo">{{ $reservation->companyData->company_address }}</x-web.attribute-value>
                            <x-web.attribute-value label="IČO">{{ $reservation->companyData->ICO }}</x-web.attribute-value>
                        </div>
                    @endif

                    <div x-show="selectedTab == 'address'" class="flex flex-col md:grid grid-cols-2 mx-auto gap-x-8 xl:gap-x-32 gap-y-4 px-6">
                        <x-web.attribute-value label="Ulice">{{ $reservation->address->street }}</x-web.attribute-value>
                        <x-web.attribute-value label="Č.P.">{{ $reservation->address->postcode }}</x-web.attribute-value>
                        <x-web.attribute-value label="Město">{{ $reservation->address->town }}</x-web.attribute-value>
                        <x-web.attribute-value label="PSČ">{{ $reservation->address->postcode }}</x-web.attribute-value>
                        <x-web.attribute-value label="Země">{{ $reservation->address->country }}</x-web.attribute-value>
                    </div>
                @endif
            </div>
            <x-web.confirm-action-modal id="cancelReservation">
                <svg class="mx-auto mb-4 text-black w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-bold text-black">Opravdu si přejete zrušit rezervaci?</h3>
                <div class="flex justify-between max-w-[250px] gap-x-5 mx-auto">
                    <x-web.button class="flex-1" :route="route('profile.my-reservations.my-reservation.cancel', $reservation->id)" data-modal-hide="cancelReservation" type="danger">Potvrdit</x-web.button>
                    <x-web.button class="flex-1" data-modal-hide="cancelReservation" type="white">Zpět</x-web.button>
                </div>

            </x-web.confirm-action-modal>
        </div>

    </x-web.layouts.dashboard>
</x-web.layouts.app>
