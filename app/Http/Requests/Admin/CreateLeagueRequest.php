<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateLeagueRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'unique:leagues,name'],
            'year' => ['required', 'numeric'],
            'start' => ['required', 'date', 'before_or_equal:end'],
            'end' => ['nullable', 'date', 'after_or_equal:start'],
            'description' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Název je povinný',
            'name.string' => 'Název musí být řetězec',
            'name.unique' => 'Liga s tímto názvem již existuje',
            'year.required' => 'Rok je povinný',
            'year.numeric' => 'Zadaný rok je ve špatném formátu',
            'start.required' => 'Začátek je povinný',
            'start.date' => 'Začátek musí být platné datum',
            'start.before_or_equal' => 'Začátek musí být před nebo stejný jako konec',
            'end.date' => 'Konec musí být platné datum',
            'end.after_or_equal' => 'Konec musí být ve stejné datum jako začátek nebo po něm',
            'description.required' => 'Popis je povinný',
            'description.string' => 'Popis musí být textový řetězec',

        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
