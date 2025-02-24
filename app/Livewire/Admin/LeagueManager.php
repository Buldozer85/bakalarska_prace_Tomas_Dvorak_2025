<?php

namespace App\Livewire\Admin;

use App\Models\League;
use App\Models\LeagueRound;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LeagueManager extends Component
{
    #[Locked]
    public League $league;

    #[Validate('required|string', message: ['required' => 'Název je povinný', 'string' => 'Název musí být řetězec'])]
    public string $name;

    #[Validate('required|string', message: ['required' => 'Popis je povinný', 'string' => 'Popis musí být řetězec'])]
    public string $description;

    #[Validate('required|numeric|min:2000', message: ['required' => 'Rok je povinný', 'string' => 'Rok musí být číslo', 'min' => 'Rok nesmí být menší než 2000'])]
    public string $year;

    #[Validate('required|date|before_or_equal:end', message: ['required' => 'Začátek je povinný', 'date' => 'Začátek musí být datum', 'before_or_equal' => 'Začátek musí být ve stejný datum jako konec nebo před ním'])]
    public string $start;

    #[Validate('required|date|after_or_equal:start', message: ['required' => 'Konec je povinný', 'date' => 'Konec musí být datum', 'after_or_equal' => 'Konec musí být ve stejný datum jako začátek a nebo po něm'])]
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

    public function deleteRound(LeagueRound $round): void
    {
        $roundNumber = $round->number;
        $round->delete();
        flash('Kolo č.'.$roundNumber.' bylo smazáno');
    }

    public function updateInfo(): void
    {
        $this->validate();

        $this->league->name = $this->name;
        $this->league->description = $this->description;
        $this->league->year = $this->year;
        $this->league->start = $this->start;
        $this->league->end = $this->end;
        $this->league->save();

        flash('Liga byla upravena');
    }
}
