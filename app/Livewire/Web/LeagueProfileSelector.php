<?php

namespace App\Livewire\Web;

use App\Models\League;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Locked;
use Livewire\Component;

class LeagueProfileSelector extends Component
{
    #[Locked]
    public Collection $userLeagues;

    public ?int $selectedLeague;

    public function mount()
    {
        $this->userLeagues = user()->activeLeagues;
        $this->selectedLeague = $this->userLeagues->first()?->id;
    }

    public function render()
    {
        $league = League::find($this->selectedLeague);

        $currentRound = $league?->rounds
            ->where('from', '>=', now()->format('Y-m-d'))
            ->first();

        if (is_null($currentRound)) {

            return view('livewire.web.league-profile-selector')->with([
                'currentRound' => $currentRound,
                'previousRound' => null,
            ]);
        }

        $previousRound = $league->rounds->where('number', '<', $currentRound->number)->first();

        return view('livewire.web.league-profile-selector')->with([
            'currentRound' => $currentRound,
            'previousRound' => $previousRound,
        ]);
    }

    public function getLeagueSelect(): array
    {
        $leagues = [];

        foreach ($this->userLeagues as $userLeague) {
            $leagues[$userLeague->id] = $userLeague->name;
        }

        return $leagues;
    }
}
