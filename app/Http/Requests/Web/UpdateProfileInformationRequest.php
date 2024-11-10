<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileInformationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required','string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Jméno je povinné',
            'first_name.string' => 'Jméno musí být řetězec',
            'first_name.max' => 'Jméno překročilo povolený počet znaků (255)',
            'last_name.required' => 'Příjmení je povinné',
            'last_name.string' => 'Příjmení musí být řetězec',
            'last_name.max' => 'Příjmení překročilo povolený počet znaků (255)',
            'phone.required' => 'Telefonní číslo je povinné',
            'phone.string' => 'Telefonní číslo musí být řetězec',
        ];
    }
}
