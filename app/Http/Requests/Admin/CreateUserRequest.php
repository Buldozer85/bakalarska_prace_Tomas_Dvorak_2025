<?php

namespace App\Http\Requests\Admin;

use App\Enums\Roles;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:254', Rule::unique('users', 'email')],
            'role' => ['required', Rule::in([Roles::USER->value, Roles::ADMINISTRATOR->value, Roles::LEAGUE_ADMINISTRATOR->value, Roles::SERVICES_ADMINISTRATOR->value])],
            'phone' => ['required', 'string', 'max:255'],
            'email_verified_at' => ['bool', 'required'],
            'password' => ['nullable', 'string', 'confirmed'],
            'password_confirmation' => ['nullable', 'string', 'required_with:password'],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Příjmení je povinné',
            'first_name.string' => 'Příjmení musí být řetězec',
            'first_name.max' => 'Příjmení může obshaovat maximálně 255 znaků',
            'last_name.required' => 'Příjmení je povinné',
            'last_name.string' => 'Příjmení musí být řetězec',
            'last_name.max' => 'Příjmení může obshaovat maximálně 255 znaků',
            'email.required' => 'E-mail je povinný',
            'email.email' => 'Zadaný e-mail je v nesprávném formátu',
            'email.max' => 'Příjmení může obshaovat maximálně 254 znaků',
            'email.unique' => 'Zadný e-mail již existuje',
            'role.required' => 'Role musí být vybrána',
            'role.in' => 'Vybraná role neexistuje',
            'phone.required' => 'Telefon musí být vyplněný',
            'phone.string' => 'Heslo musí být řetězec',
            'phone.max' => 'Telefon může být dlouhý maximálně 255 znaků',
            'email_verified_at.bool' => 'Potvrzený e-mail musí být Ano nebo Ne',
            'emai_verified_at.required' => 'Potvrzení e-mailu je povinné',
            'password.string' => 'Heslo musí být řetězec',
            'password.confirmed' => 'Zadaná hesla se neshodují',
            'password_confirmation.string' => 'Heslo znovu musí být řetězec',
            'password_confirmation.required_with' => 'Pro změnu hesla, musí být heslo znovu vyplněno',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
