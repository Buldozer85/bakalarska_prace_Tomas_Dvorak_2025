<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required_with:password'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'password.confirmed' => 'Hesla se neshodují',
            'password.required' => 'Heslo je povinné',
            'password_confirmation.required_with' => 'Pro změnu hesla je nutno zadat heslo znovu',
        ];
    }
}
