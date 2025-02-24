<?php

use App\Models\User;
use App\Models\WebsiteSetting;
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

if (! function_exists('makeInitials')) {
    function makeInitials(string $name): ?string
    {
        $exploded = explode(' ', $name);

        if (empty($exploded)) {
            return null;
        }

        if (count($exploded) > 2) {
            return mb_strtoupper(Str::take($exploded[0], 1).Str::take($exploded[2], 1));
        }

        return mb_strtoupper(Str::take($exploded[0], 1).Str::take($exploded[1], 1));
    }
}

if (! function_exists('unseenMessages')) {
    function unseenMessages(): int
    {
        return \App\Models\Message::query()
            ->whereNull('viewed')
            ->when(user()->is_admin, function ($query) {
                return $query->where('sender_email', '!=', config('mail.from.address'));
            })
            ->when(! user()->is_admin, function ($query) {
                return $query->where('sender_email', '!=', user()->email);
            })->count();
    }
}

if (! function_exists('settings')) {
    function settings(string $key): string
    {
        if (Cache::has($key)) {
            return Cache::get($key);
        }

        $setting = WebsiteSetting::query()->where('key', $key)->first();

        if (is_null($setting)) {
            return $key;
        }

        Cache::put($key, $setting->value);

        return $setting->value;
    }
}

if (! function_exists('openingStart')) {
    function openingStart(): int
    {
        $start = explode(':', settings('opening.start'));

        return intval($start[0]);
    }
}

if (! function_exists('openingEnd')) {
    function openingEnd(): int
    {
        $end = explode(':', settings('opening.end'));

        return intval($end[0]);
    }
}

if (! function_exists('daysOfWeekIndexes')) {
    function daysOfWeekIndexes(string $day): int|bool
    {
        $days = ['PO', 'ÚT', 'ST', 'ČT', 'PÁ', 'SO', 'NE'];

        return array_search($day, $days);
    }
}
