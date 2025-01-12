<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string $from_name
 * @property string $from_email
 */
class Conversation extends Model
{
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'conversation_id', 'id');
    }

    public function unseenMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'conversation_id', 'id')
            ->whereNull('viewed')
            ->when(user()->is_admin, function ($query) {
                return $query->where('sender_email', '!=', config('mail.from.address'));
            })
            ->when(! user()->is_admin, function ($query) {
                return $query->where('sender_email', '!=', user()->email);
            });
    }

    public function conversationStarterUser(): HasOne
    {
        return $this->hasOne(User::class, 'email', 'from_email');
    }
}
