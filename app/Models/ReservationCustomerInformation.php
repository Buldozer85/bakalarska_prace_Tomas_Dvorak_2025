<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string $email
 * @property int $reservation_id
 * @property string $full_name
 */
class ReservationCustomerInformation extends Model
{
    public function fullName(): Attribute
    {
        return Attribute::make(get: fn () => $this->first_name.' '.$this->last_name);
    }
}
