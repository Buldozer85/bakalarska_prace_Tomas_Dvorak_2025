<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $town
 * @property string $street
 * @property string $number
 * @property string $postcode
 * @property string $country
 */
class UserAddress extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
