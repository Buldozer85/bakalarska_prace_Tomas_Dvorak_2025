<?php

namespace App\Livewire\Admin;

use App\Models\League;
use App\Models\LeagueRound;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Attributes\Locked;
use Livewire\Component;

class LeagueManager extends Component
{
    #[Locked]
    public League $league;

    public string $name;

    public string $description;

    public string $year;

    public string $start;

    public string $end;

    public Collection $usersInLeague;

    public Collection $usersCollection;

    public array $users = [];

    public function mount()
    {
        $this->name = $this->league->name;
        $this->description = $this->league->description;
        $this->year = $this->league->year;
        $this->start = $this->league->start->format('Y-m-d');
        $this->end = $this->league->end->format('Y-m-d');
        $this->usersInLeague = $this->league->rankedPlayers;

        $this->usersCollection = User::query()->get();

        foreach ($this->usersCollection as $user) {
            if ($this->usersInLeague->contains($user)) {
                continue;
            }

            $this->users[$user->id] = $user->full_name;
        }
    }

    public function addPlayer(?User $user): void
    {
        $this->league->players()->attach($user);
        $this->usersInLeague = $this->league->players;
        $this->refreshUsers();

        $this->dispatch('player-added', selectedUser: array_key_first($this->users))->self();
    }

    public function removePlayer(User $user): void
    {
        $this->league->players()->detach($user);
        $this->usersInLeague = $this->league->players;
        $this->refreshUsers();
    }

    public function render()
    {
        return view('livewire.admin.league-manager');
    }

    public function refreshUsers(): void
    {
        $this->users = [];

        foreach ($this->usersCollection as $user) {
            if ($this->usersInLeague->contains($user)) {
                continue;
            }

            $this->users[$user->id] = $user->full_name;
        }
    }

    public function deleteRound(LeagueRound $round)
    {
        $roundNumber = $round->number;
        $round->delete();
        flash('Kolo č.'.$roundNumber.' bylo smazáno');
    }
}
