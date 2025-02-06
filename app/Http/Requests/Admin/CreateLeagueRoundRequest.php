<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateLeagueRoundRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'number' => ['required', 'integer', 'min:0'],
            'from' => ['required', 'date', 'before_or_equal:to'],
            'to' => ['required', 'date', 'after_or_equal:from'],
        ];
    }

    public function messages(): array
    {
        return [
            'number.required' => 'Číslo kola je povinné',
            'number.integer' => 'Číslo mustí být číslovka',
            'number.unique' => 'Kolo již existuje',
            'number.min' => 'Minimlní hodnota pro číslo je 0',
            'from.required' => 'Od musí být povinné',
            'from.date' => 'Od musí být datum',
            'from.before_or_equal' => 'Od musí být před nebo ve stejný den jako Do',
            'to.required' => 'Do je povinné',
            'to.date' => 'Do musí být datum',
            'to.after_or_equal' => 'Do musí být po nebo ve stejný den jako Od',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
