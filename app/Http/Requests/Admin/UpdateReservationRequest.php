<?php

namespace App\Http\Requests\Admin;

use App\Enums\ReservationTypes;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateReservationRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        flash('Zadali jste nesprávné údaje nebo jse nevyplnili všechny povinné údaje', 'error');
        parent::failedValidation($validator); // TODO: Change the autogenerated stub
    }

    public function rules(): array
    {
        return [
            'note' => ['nullable', 'string'],
            'reservation_type' => ['required', Rule::in(ReservationTypes::types())],
            'phone' => ['required'],
            'on_company' => ['nullable', 'boolean'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'street' => ['required', 'string'],
            'number' => ['required', 'string'],
            'town' => ['required', 'string'],
            'postcode' => ['required', 'string'],
            'company_name' => ['required_with:on_company', 'nullable', 'string'],
            'company_address' => ['required_with:on_company', 'nullable', 'string'],
            'ico' => ['required_with:on_company', 'nullable', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'phone.required' => 'Telefonní číslo je povinné',
            'first_name.required' => 'Jméno je povinné',
            'first_name.string' => 'Jméno musí být řetězec',
            'last_name.required' => 'Příjmení je povinné',
            'last_name.string' => 'Příjmení je povinné',
            'email.email' => 'Email je v nesprávném formátu',
            'email.required' => 'Email je povinný',
            'street.required' => 'Ulice je povinná',
            'street.string' => 'Ulice musí být řetězec',
            'number.required' => 'Č.P. je povinné',
            'number.string' => 'Č.P. musí být řetězec',
            'town.required' => 'Město je povinné',
            'town.string' => 'Město musí být řetězec',
            'postcode.required' => 'PSČ je povinné',
            'postcode.string' => 'PSČ musí být řetězec',
            'company_address.required_with' => 'Sídlo musí být vyplněno',
            'company_address.string' => 'Sídlo firmy musí být řetězec',
            'company_name.required_with' => 'Název firmy musí být vyplněn',
            'company_name.string' => 'Název firmy musí být řetězec',
            'ico.required_with' => 'IČO musí být vyplněno',
            'ico.string' => 'IČO firmy musí být řetězec',
            'note.string' => 'Poznámka musí být řetězec',
            'reservation_type.required' => 'Musí být vybrán typ rezervace',
            'reservation_type.in' => 'Vybrali jste neexistující typ rezervace',
            'on_company.boolean' => 'Hodnota Na firmu může být pouze ANO/NE',
        ];
    }
}
