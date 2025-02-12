<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $year
 * @property Carbon $start
 * @property ?Carbon $end
 * @property string $description
 * @property string $from_to
 */
class League extends Model
{
    protected function casts(): array
    {
        return [
            'start' => 'datetime',
            'end' => 'datetime',
        ];
    }

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'league_players', 'league_id', 'user_id')
            ->withPivot('score', 'id');
    }

    public function leaguePlayers(): HasMany
    {
        return $this->hasMany(LeaguePlayer::class, 'league_id', 'id')->with('user');
    }

    public function rankedLeaguePlayers(): HasMany
    {
        return $this->hasMany(LeaguePlayer::class, 'league_id', 'id')->orderBy('score', 'desc');
    }

    public function rankedPlayers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'league_players', 'league_id', 'user_id')
            ->withPivot('score', 'id')
            ->orderByPivot('score', 'desc');
    }

    public function rounds(): HasMany
    {
        return $this->hasMany(LeagueRound::class);
    }

    public function getRankOfPlayer(int $playerId): int
    {
        return $this->players()->selectRaw('*, RANK() OVER (ORDER BY pivot_score DESC) as rank')->where('league_players.id', $playerId)->get()->first()->rank;
    }

    public function fromTo(): Attribute
    {
        return Attribute::make(get: fn () => $this->start->format('j. n. Y').' - '.$this->end->format('j. n. Y') ?? '');
    }
}
