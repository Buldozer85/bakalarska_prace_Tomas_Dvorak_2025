<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class SendContactMessageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Jméno je povinné',
            'name.string' => 'Jméno musí být řetězec',
            'name.max' => 'Jméno nesmí překročit 255 znaků',
            'email.required' => 'E-mail je povinný',
            'email.email' => 'E-mail je v nesprávném formátu',
            'email.max' => 'E-mail nesmí překročit 255 znaků',
            'message.required' => 'Zpráva je povinná',
            'message.string' => 'Zpráva musí být řetězec',

        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
