<?php

namespace App\Enums;

enum Roles: string
{
    case ADMINISTRATOR = 'administrator';
    case USER = 'user';
    //case SERVICES_ADMINISTRATOR = 'services_administrator';
    //case LEAGUE_ADMINISTRATOR = 'league_administrator';

    public static function adminGroup(): array
    {
        return [self::ADMINISTRATOR];
    }

    public static function options(): array
    {
        return [
            'unselected' => 'Vybrat roli',
            self::ADMINISTRATOR->value => 'Administrátor',
            //self::SERVICES_ADMINISTRATOR->value => 'Administrátor služeb',
            //self::LEAGUE_ADMINISTRATOR->value => 'Administrátor ligy',
            self::USER->value => 'Uživatel',
        ];
    }

    public function label(): string
    {
        return match ($this) {
            self::ADMINISTRATOR => 'Administrátor',
            // self::SERVICES_ADMINISTRATOR => 'Administrátor služeb',
            // self::LEAGUE_ADMINISTRATOR => 'Administrátor ligy',
            self::USER => 'Uživatel',
        };
    }
}
