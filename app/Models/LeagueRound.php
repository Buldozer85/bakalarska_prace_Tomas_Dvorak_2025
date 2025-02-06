<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $number
 * @property bool $is_finished
 * @property Carbon $from
 * @property Carbon $to
 * @property int $league_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $from_to
 */
class LeagueRound extends Model
{
    protected function casts(): array
    {
        return [
            'is_finished' => 'boolean',
            'from' => 'date',
            'to' => 'date',
        ];
    }

    public function rankedLeaguePlayers(): BelongsToMany
    {
        return $this->belongsToMany(LeaguePlayer::class, 'round_players', 'league_round_id', 'league_player_id')
            ->withPivot(['score', 'confirmed', 'id', 'created_at'])
            ->orderBy('score', 'DESC');
    }

    public function leaguePlayers(): BelongsToMany
    {
        return $this->belongsToMany(LeaguePlayer::class, 'round_players', 'league_round_id', 'league_player_id')
            ->withPivot(['score', 'confirmed', 'id', 'created_at']);
    }

    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class);
    }

    public function players(): HasMany
    {
        return $this->hasMany(RoundPlayer::class, 'league_round_id');
    }

    public function fromTo(): Attribute
    {
        return Attribute::make(get: fn () => $this->from->format('j. n.').' - '.$this->to->format('j. n.'));
    }
}
