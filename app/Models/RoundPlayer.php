<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $league_round_id
 * @property int $league_player_id
 * @property float $score
 * @property Carbon $confirmed
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class RoundPlayer extends Model
{
    protected function casts(): array
    {
        return [
            'confirmed' => 'datetime',
        ];
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(LeaguePlayer::class, 'league_player_id')->with('user');
    }
}
