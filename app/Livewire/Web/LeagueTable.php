<?php

namespace App\Livewire\Web;

use Livewire\Component;

class LeagueTable extends Component
{
    public string $selectedView = 'weekly';

    public function render()
    {
        return view('livewire.web.league-table');
    }

    public function setView(string $view): void
    {
        $this->selectedView = $view;
    }
}
