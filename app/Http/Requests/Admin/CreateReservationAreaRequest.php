<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateReservationAreaRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'is_active' => [Rule::in([0, 1]), 'required'],
            'key' => ['required', Rule::unique('reservation_areas', 'key')],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Název musí být vyplněn',
            'name.string' => 'Název musí být řetězec',
            'is_active.in' => 'Aktivní musí být Ano nebo Ne',
            'is_active.required' => 'Aktivní je povinná hodnota',
            'key.required' => 'Klíč je povinný',
            'key.unique' => 'Klíč musí být unikátní',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
