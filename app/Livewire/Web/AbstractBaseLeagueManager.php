<?php

namespace App\Livewire\Web;

use App\Models\League;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class AbstractBaseLeagueManager extends Component
{
    public string $selectedTab = 'weekly';

    public int $roundGroup = 0;

    #[Locked]
    public ?League $leagueModel;

    #[Computed]
    public function splitRounds()
    {
        return $this->leagueModel->orderedRounds->split(round($this->leagueModel->rounds->count()));
    }

    public function nextRoundGroup(): void
    {
        if (count($this->splitRounds) - 1 === $this->roundGroup) {
            return;
        }

        $this->roundGroup++;
    }

    public function previousRoundGroup(): void
    {
        if ($this->roundGroup === 0) {
            return;
        }

        $this->roundGroup--;
    }
}
