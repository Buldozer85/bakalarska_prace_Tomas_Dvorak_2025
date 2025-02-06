<?php

namespace App\Livewire\Web;

use App\Models\League;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Locked;
use Livewire\Component;

class LeagueTable extends Component
{
    public string $selectedTab = 'weekly';

    #[Locked]
    public Collection $leagues;

    #[Locked]
    public League $selectedLeagueModel;

    public int $selectedLeague;

    public ?int $selectedRound;

    public string $name = '';

    public function mount()
    {
        $this->leagues = League::query()->has('rounds')->get();
        $this->selectedLeagueModel = $this->leagues->first();
        $this->selectedLeague = $this->selectedLeagueModel->id;
        $this->selectedRound = $this->selectedLeagueModel->rounds->first()?->id;
    }

    public function render()
    {
        $leagueRounds = $this->selectedLeagueModel->rounds;

        return view('livewire.web.league-table')->with([
            'leagueRounds' => $leagueRounds,
        ]);
    }

    public function setView(string $view): void
    {
        $this->selectedView = $view;
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
        $this->selectedLeagueModel = $this->leagues->where('id', $this->selectedLeague)->first();
        $this->selectedRound = $this->selectedLeagueModel->rounds->first()?->id;
    }

    public function getRoundPlayers(): \Illuminate\Support\Collection
    {
        if (empty($this->name)) {
            return $this->selectedLeagueModel
                ->rounds
                ->where('id', $this->selectedRound)
                ->first()
                ?->leaguePlayers
                ->sortByDesc(fn ($player) => $player->pivot->score) ?? collect();
        }

        $nameExploded = explode(' ', $this->name);

        return $this->selectedLeagueModel
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
            return $this->selectedLeagueModel
                ->rankedLeaguePlayers;
        }

        $nameExploded = explode(' ', $this->name);

        return $this->selectedLeagueModel
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
