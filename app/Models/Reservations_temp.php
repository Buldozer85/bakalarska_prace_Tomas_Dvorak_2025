<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservations_temp extends Model
{
    protected $table = 'reservations_temp';

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'slot_from' => 'datetime',
            'slot_to' => 'datetime',
        ];
    }
}
