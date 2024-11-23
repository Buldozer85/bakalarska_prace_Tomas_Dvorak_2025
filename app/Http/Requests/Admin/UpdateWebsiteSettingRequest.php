<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateWebsiteSettingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'key' => ['required', 'string', Rule::unique('website_settings', 'key')->ignore($this->websiteSetting->id)],
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
