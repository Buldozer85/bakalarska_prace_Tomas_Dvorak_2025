<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

/**
 * @property Carbon $date
 * @property int $id
 * @property Carbon $slot_from
 * @property Carbon $slot_to
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $user_id
 * @property int reservation_area_id
 */
class ReservationTemp extends Model
{
    use Prunable;

    protected $table = 'reservations_temp';

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'slot_from' => 'datetime',
            'slot_to' => 'datetime',
        ];
    }

    public function prunable(): Builder
    {
        return static::where('created_at', '>=', now()->addMinutes(15));
    }
}
