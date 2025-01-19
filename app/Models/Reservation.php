<?php

namespace App\Models;

use App\Enums\ReservationTypes;
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
 * @property ReservationTypes $type
 * @property string $from_to
 * @property bool $on_company
 * @property string $status
 * @property string $on_company_label
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
            'type' => ReservationTypes::class,
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

    public function customerInformation(): HasOne
    {
        return $this->hasOne(ReservationCustomerInformation::class, 'reservation_id');
    }

    public function companyData(): HasOne
    {
        return $this->hasOne(ReservationCompanyData::class);
    }

    public function fromTo(): Attribute
    {
        return Attribute::make(get: function () {
            return $this->slot_from->format('G:i').' - '.$this->slot_to->copy()->addHour()->format('G:i');
        });
    }

    public function status(): Attribute
    {
        return Attribute::make(get: function () {
            if (! is_null($this->cancelled)) {
                return ['key' => 'cancelled', 'label' => 'Zrušena'];
            }

            if (! is_null($this->confirmed)) {
                return ['key' => 'confirmed', 'label' => 'Potvrzena'];
            }

            return ['key' => 'waiting', 'label' => 'Čeká na vyřízení'];
        });
    }

    public function onCompanyLabel(): Attribute
    {
        return Attribute::make(get: fn () => $this->on_company ? 'Ano' : 'Ne');
    }
}
