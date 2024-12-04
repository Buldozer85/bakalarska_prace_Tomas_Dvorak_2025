<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserAddressRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'town' => ['required', 'string'],
            'street' => ['required', 'string'],
            'number' => ['required', 'string'],
            'postcode' => ['required', 'string'],
            'country' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'town.required' => 'Město je povinné',
            'town.string' => 'Město musí být řetězec',
            'street.required' => 'Ulice je povinná',
            'street.string' => 'Ulice musí být řetězec',
            'number.required' => 'Číslo popisné je povinné',
            'number.string' => 'Číslo popisné musí být řetězec',
            'postcode.required' => 'PSČ je povinné',
            'postcode.string' => 'PSČ musí být řetězec',
            'country.required' => 'Země je povinná',
            'country.string' => 'Země musí být řetězec',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
