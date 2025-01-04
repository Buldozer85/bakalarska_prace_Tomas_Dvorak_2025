<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $message
 * @property Carbon $sent
 * @property ?Carbon $viewed
 * @property int $conversation_id
 * @property string $sender_email
 */
class Message extends Model
{
    protected function casts(): array
    {
        return [
            'sent' => 'datetime',
            'viewed' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }
}
