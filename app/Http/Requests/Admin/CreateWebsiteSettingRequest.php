<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateWebsiteSettingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'key' => ['required', 'string', 'unique:website_settings,key'],
            'value' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'key.required' => 'Klíč musí být vyplněn',
            'key.string' => 'Klíč musí být textový řetězec',
            'key.unique' => 'Zadaný klíč již existuje',
            'value.required' => 'Hodnota musí být vyplněna',
            'value.string' => 'Hodnota musí být textový řetězec',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
