<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $town
 * @property string $street
 * @property string $number
 * @property string $postcode
 * @property string $country
 * @property string $full_address
 */
class ReservationAddress extends Model
{
    public function fullAddress(): Attribute
    {
        return Attribute::make(get: fn () => $this->street.' '.$this->number.', '.$this->postcode.' '.$this->town);
    }
}
