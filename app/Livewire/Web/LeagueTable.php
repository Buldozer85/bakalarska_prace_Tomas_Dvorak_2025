<?php

namespace App\Livewire\Web;

use App\Models\League;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Locked;

class LeagueTable extends AbstractBaseLeagueManager
{
    #[Locked]
    public Collection $leagues;

    public int $selectedLeague;

    public ?int $selectedRound;

    public string $name = '';

    public function mount()
    {
        $this->leagues = League::query()->has('rounds')->get();
        $this->leagueModel = $this->leagues->first();
        $this->selectedLeague = $this->leagueModel->id;
        $this->selectedRound = $this->leagueModel->rounds->first()?->id;

    }

    public function render()
    {
        $leagueRounds = $this->leagueModel->rounds;

        return view('livewire.web.league-table')->with([
            'leagueRounds' => $leagueRounds,
        ]);
    }

    public function getLeagueSelect(): array
    {
        $leagues = [];

        foreach ($this->leagues as $league) {
            $leagues[$league->id] = $league->name;
        }

        return $leagues;
    }

    public function updatedSelectedLeague()
    {
        $this->leagueModel = $this->leagues->where('id', $this->selectedLeague)->first();
        $this->selectedRound = $this->leagueModel->rounds->first()?->id;
    }

    public function getRoundPlayers(): \Illuminate\Support\Collection
    {
        if (empty($this->name)) {
            return $this->leagueModel
                ->rounds
                ->where('id', $this->selectedRound)
                ->first()
                ?->leaguePlayers
                ->sortByDesc(fn ($player) => $player->pivot->score) ?? collect();
        }

        $nameExploded = explode(' ', $this->name);

        return $this->leagueModel
            ->rounds()
            ->where('id', $this->selectedRound)
            ->first()
            ?->leaguePlayers()
            ->whereHas('user', function ($query) use ($nameExploded) {
                $query->where('first_name', 'LIKE', "$nameExploded[0]%");
                if (count($nameExploded) > 1) {
                    $query->where('last_name', 'LIKE', "$nameExploded[1]%");
                }

            })
            ->orderByDesc('pivot_score')

            ->get() ?? collect();

    }

    public function getAllPlayers(): \Illuminate\Support\Collection
    {
        if (empty($this->name)) {
            return $this->leagueModel
                ->rankedLeaguePlayers;
        }

        $nameExploded = explode(' ', $this->name);

        return $this->leagueModel
            ->leaguePlayers()
            ->whereHas('user', function ($query) use ($nameExploded) {
                $query->where('first_name', 'LIKE', "$nameExploded[0]%");
                if (count($nameExploded) > 1) {
                    $query->where('last_name', 'LIKE', "$nameExploded[1]%");
                }
            })

            ->get() ?? collect();

    }

    public function setSelectedRound(int $round): void
    {
        $this->selectedRound = $round;
    }
}
