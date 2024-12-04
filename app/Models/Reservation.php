<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property Carbon $date
 * @property Carbon $slot_from
 * @property Carbon $slot_to
 * @property ?Carbon $confirmed
 * @property ?Carbon $changed
 * @property ?Carbon $cancelled
 * @property ?Carbon $payed
 * @property string $note
 * @property bool $with_areal
 * @property string $type
 * @property string $from_to
 * @property bool $on_company
 * @property string $status
 */
class Reservation extends Model
{
    protected function casts(): array
    {
        return [
            'date' => 'date',
            'slot_from' => 'datetime',
            'slot_to' => 'datetime',
            'confirmed' => 'datetime',
            'changed' => 'datetime',
            'cancelled' => 'datetime',
            'payed' => 'datetime',
            'with_areal' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function address(): HasOne
    {
        return $this->hasOne(ReservationAddress::class);
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(ReservationArea::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(ReservationDocuments::class);
    }

    public function fromTo(): Attribute
    {
        return Attribute::make(get: function () {
            return $this->slot_from->format('G:i').' - '.$this->slot_to->format('G:i');
        });
    }

    public function status(): Attribute
    {
        return Attribute::make(get: function () {
            return ''; // TODO
        });
    }
}
