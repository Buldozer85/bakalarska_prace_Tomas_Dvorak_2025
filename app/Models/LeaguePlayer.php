<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property float $score
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $user_id
 * @property int league_id
 */
class LeaguePlayer extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class);
    }

    public function playedRounds(): BelongsToMany
    {
        return $this->belongsToMany(LeagueRound::class, 'round_players', 'league_player_id', 'league_round_id')->withPivot(['score', 'confirmed']);
    }

    public function getScoreToRound(int $roundNumber): float
    {
        return $this->playedRounds->where('number', '<=', $roundNumber)->sum(function (LeagueRound $round) {
            return $round->pivot->confirmed ? $round->pivot->score : 0;
        });
    }

    public function rank(): Attribute
    {
        return Attribute::make(get: function () {
            return $this->league->rankedLeaguePlayers->search(function (LeaguePlayer $item) {
                return $item->id === $this->id;
            }) + 1;
        });
    }

    public function rankAfterRound(int $roundNumber): int
    {
        $collection = collect();

        $this->league->rounds->where('number', '<=', $roundNumber)->each(function (LeagueRound $round) use ($collection) {
            foreach ($round->rankedLeaguePlayers as $player) {
                $score = $player->pivot->score;

                if ($collection->has($player->id)) {
                    $score = $collection->get($player->id) + $score;
                }
                $collection->put($player->id, $score);
            }
        });

        $collection = $collection->sortByDesc(fn ($value, $key) => $value);

        $keys = $collection->keys();

        return $keys->search($this->id) + 1;
    }
}
