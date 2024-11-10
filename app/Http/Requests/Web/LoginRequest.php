<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
          'email.required' => 'Email je povinný',
          'email.string' => 'Email musí být řetězec',
          'email.email' => 'Zadaný email je v nesprávném formátu',
          'password.required' => 'Heslo je povinné',
          'password.string' => 'Heslo musí být řetězec'
        ];
    }
}
