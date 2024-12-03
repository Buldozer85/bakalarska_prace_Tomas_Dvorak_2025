<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

if (! function_exists('user')) {
    function user(): User|Authenticatable|null
    {
        return Auth::user();
    }
}

if (! function_exists('month')) {
    function month(int $index): ?string
    {
        $months = ['Leden', 'Únor', 'Březen', 'Duben', 'Květen', 'Červen', 'Červenec', 'Srpen', 'Září', 'Říjen', 'Listopad', 'Prosinec'];

        if (! array_key_exists($index, $months)) {
            return null;
        }

        return $months[$index];
    }
}

if (! function_exists('monthInInflection')) {
    function monthInInflection(int $index): ?string
    {
        $months = ['ledna', 'února', 'března', 'dubna', 'května', 'června', 'července', 'srpna', 'září', 'října', 'listopadu', 'prosince'];

        if (! array_key_exists($index, $months)) {
            return null;
        }

        return $months[$index];
    }
}

if (! function_exists('daysOfWeek')) {
    function daysOfWeek(int $index): ?string
    {
        $days = ['PO', 'ÚT', 'ST', 'ČT', 'PÁ', 'SO', 'NE'];

        if (! array_key_exists($index, $days)) {
            return null;
        }

        return $days[$index];
    }
}

if (! function_exists('inPast')) {
    function inPast(Carbon $firstDate, Carbon $secondDate): bool
    {
        return $firstDate->lt($secondDate);
    }
}

if (! function_exists('flash')) {
    function flash(string $message, $type = 'success'): void
    {
        session()->flash('flashMessage', ['message' => $message, 'type' => $type]);
    }
}
