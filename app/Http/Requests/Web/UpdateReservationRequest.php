<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [];

        if ($this->reservation->on_company) {
            $rules['company_name'] = ['required', 'string'];
            $rules['ICO'] = ['required', 'string'];
            $rules['company_address'] = ['required', 'string'];
        }

        return array_merge($rules, [
            'phone' => ['required'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'street' => ['required', 'string'],
            'number' => ['required', 'string'],
            'town' => ['required', 'string'],
            'postcode' => ['required', 'string'],
            'country' => ['required', 'string'],
        ]);
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
            'country.required' => 'Země je povinná',
        ];
    }
}
