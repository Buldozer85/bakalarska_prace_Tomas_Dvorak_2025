<x-web.layouts.app title="Úspěšná rezervace">
    <div class="flex flex-col max-w-[1000px] mx-auto shadow-lg mt-12 max-lg:mx-8">
        <div class="bg-brand text-white text-center flex-1 flex justify-center flex-col p-12 space-y-4 ">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-12 w-12 mx-auto">
                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
            </svg>
            <h1 class="font-bold text-2xl">Rezervace byla úspěšná</h1>
            <h2 class="text-brand-yellow font-normal">Číslo rezervace je: #{{ $reservation->id }}</h2>
            <p>Potvrzení naleznete ve své e-mailové schránce</p>
        </div>

        <div class="flex flex-col md:grid grid-cols-2 mx-auto gap-x-8 xl:gap-x-32 gap-y-4 py-12 px-6">
            <x-web.attribute-value label="Jméno">{{ $reservation->customerInformation->first_name }}</x-web.attribute-value>
            <x-web.attribute-value label="Příjmení">{{ $reservation->customerInformation->last_name }}</x-web.attribute-value>
            <x-web.attribute-value label="E-mail">{{ $reservation->customerInformation->email }}</x-web.attribute-value>
            <x-web.attribute-value label="Telefon">{{ $reservation->customerInformation->phone }}</x-web.attribute-value>
            <x-web.attribute-value label="Datum">{{ $reservation->date->format('j. n. Y') }}</x-web.attribute-value>
            <x-web.attribute-value label="Od - Do">{{ $reservation->slot_from->format('G:i') }} - {{ $reservation->slot_to->copy()->addHour()->format('G:i') }}</x-web.attribute-value>
            <x-web.attribute-value label="Typ rezervace">{{ $reservation->type->label() }}</x-web.attribute-value>
            <x-web.attribute-value label="Na firmu">{{ $reservation->on_company_label }}</x-web.attribute-value>
            @if($reservation->on_company)
                <x-web.attribute-value label="Název firmy">{{ $reservation->companyData->company_name }}</x-web.attribute-value>
                <x-web.attribute-value label="Sídlo">{{ $reservation->companyData->company_address }}</x-web.attribute-value>
                <x-web.attribute-value label="IČO">{{ $reservation->companyData->ICO }}</x-web.attribute-value>
            @endif

            <x-web.attribute-value class="col-span-2" label="Poznámka">{{ $reservation->note }}</x-web.attribute-value>
        </div>

        <div class="mx-auto pb-12">
            <x-web.button type="yellow" :route="route('homepage')">Zpět na hlavní stránku</x-web.button>
        </div>
    </div>
</x-web.layouts.app>
