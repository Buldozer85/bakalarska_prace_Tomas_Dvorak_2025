<?php

namespace App\Livewire\Web;

use App\Models\League;
use App\Models\LeaguePlayer;
use App\Models\LeagueRound;
use App\Models\RoundPlayer;
use Livewire\Attributes\Locked;
use Livewire\Component;

class LeagueDetail extends Component
{
    public League $league;

    public LeaguePlayer $player;

    #[Locked]
    public int $selectedRound;

    public LeagueRound $round;

    public ?RoundPlayer $roundPlayed = null;

    public string $selectedTab = 'weekly';

    public function mount(): void
    {
        $this->selectedRound = $this->league->rounds->first()->id;

        $this->round = $this->league->rounds->first();

        $this->player = LeaguePlayer::find($this->league->players()->where('user_id', auth()->id())->first()->pivot->id);

        $this->setRoundPlayed();
    }

    public function render()
    {
        return view('livewire.web.league-detail');
    }

    public function getRoundPlayers(): \Illuminate\Support\Collection
    {
        return $this->league
            ->rounds
            ->where('id', $this->selectedRound)
            ->first()
            ?->leaguePlayers ?? collect();
    }

    public function setSelectedRound(int $round): void
    {

        $roundModel = LeagueRound::find($round);

        if (is_null($roundModel)) {
            return;
        }

        $this->selectedRound = $round;

        $this->round = $roundModel;
        $this->setRoundPlayed();

        $this->dispatch('round-changed', score: $this->roundPlayed?->score ?? 0, number: $this->round->number);
    }

    public function hasSubmittedRoundResult(): bool
    {
        return ! is_null($this->roundPlayed);
    }

    public function setRoundScore(float $score): void
    {

        if (! is_null($this->roundPlayed)) {
            if (is_null($this->roundPlayed->pivot->confirmed)) {
                return;
            }

            $this->roundPlayed->pivot->score = $score;
            $this->roundPlayed->pivot->save();

            return;
        }

        $scored = new RoundPlayer;

        $scored->score = $score;
        $scored->league_round_id = $this->selectedRound;
        $scored->league_player_id = $this->player->id;
        $scored->save();

        $this->roundPlayed = $scored;
    }

    private function setRoundPlayed(): void
    {
        $roundPlayed = $this->round->leaguePlayers->where('id', '=', $this->player->id)->first();

        if (! is_null($roundPlayed)) {
            $this->roundPlayed = RoundPlayer::find($roundPlayed->pivot->id);

            return;
        }

        $this->roundPlayed = null;
    }
}
