@component('mail::message')
# Rezervace #{{ $reservation->id }}

## Osobní údaje
Jméno: {{ $reservation->customerInformation->full_name }} <br>
Kontaktní e-mail: {{ $reservation->customerInformation->email }} <br>
Telefon: {{ $reservation->customerInformation->phone }} <br>
Adresa: {{ $reservation->address->full_address }}

## Údaje o rezervaci
Datum: {{ $reservation->date->format('j. n. Y') }} <br>
Od - Do: {{ $reservation->from_to }} <br>
Typ: {{ $reservation->type->label() }} <br>
Rezervace na firmu: {{ $reservation->on_company_label }} <br>
@if($reservation->on_company)
Název firmy: {{ $reservation->companyData->company_name }} <br>
ICO: {{ $reservation->companyData->ICO }} <br>
Sídlo: {{ $reservation->companyData->company_address }} <br>
@endif

Poznámka: {{ $reservation->note }}

@component('mail::button', ['url' => route('administration.reservation.detail', $reservation->id)])
Zobrazit rezervaci
@endcomponent


@endcomponent
