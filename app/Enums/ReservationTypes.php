<?php

namespace App\Enums;

enum ReservationTypes: string
{
    case AREAL_PLUS_TRACK = 'areal_plus_track';

    case TRACK = 'track';

    public function label(): string
    {
        return match ($this) {
            self::AREAL_PLUS_TRACK => 'Areál a dráha',
            self::TRACK => 'Dráha',
        };
    }

    public static function select(): array
    {
        return [
            self::AREAL_PLUS_TRACK->value => 'Areál a dráha',
            self::TRACK->value => 'Dráha',
        ];
    }

    public static function labelByKey(string $key): string
    {
        return match ($key) {
            self::AREAL_PLUS_TRACK->value => 'Areál a dráha',
            self::TRACK->value => 'Dráha',
        };
    }
}
