<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:254', 'unique:users'],
            'phone' => ['required','string'],
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required', 'same:password'],
            'gdpr_agreement' => ['required'],
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
            'email.required' => 'E-mail je povinný',
            'email.email' => 'E-mail je v nesprávném formátu',
            'email.max' => 'E-mail překročil povolený počet znaků',
            'email.unique' => 'Zadaný e-mail se již používá',
            'role.required' => 'Role je povinná',
            'role.in' => 'Vybraná role neexistuje',
            'phone.required' => 'Telefonní číslo je povinné',
            'phone.string' => 'Telefonní číslo musí být řetězec',
            'password.required' => 'Heslo je povinné',
            'password.confirmed' => 'Hesla se neshodují',
            'password_confirmation.required' => 'Heslo znovu je povinné',
            'password_confirmation.same' => 'Hesla se neshodují',
            'gdpr_agreement.required' => 'Pro registraci musíte souhlasit s podmínkami'
        ];
    }
}
