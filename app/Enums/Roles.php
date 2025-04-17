<?php

namespace App\Enums;

enum Roles: string
{
    case ADMINISTRATOR = 'administrator';
    case USER = 'user';

    public static function adminGroup(): array
    {
        return [self::ADMINISTRATOR];
    }

    public static function options(): array
    {
        return [
            'unselected' => 'Vybrat roli',
            self::ADMINISTRATOR->value => 'Administrátor',
            self::USER->value => 'Uživatel',
        ];
    }

    public function label(): string
    {
        return match ($this) {
            self::ADMINISTRATOR => 'Administrátor',
            self::USER => 'Uživatel',
        };
    }
}
