<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConversationMessage extends Model
{
    protected function casts(): array
    {
        return [
            'sent' => 'datetime',
            'viewed' => 'datetime',
        ];
    }
}
