<?php

namespace App\Livewire\Web;

use Carbon\Carbon;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class ReservationMobile extends Component
{
    #[Locked]
    public Carbon $selectedDay;

    #[Locked]
    public bool $readOnly;

    public function render()
    {
        return view('livewire.web.reservation-mobile');
    }

    public function mount(?bool $readOnly)
    {
        $this->readOnly = $readOnly ?? false;
    }

    public function __construct()
    {
        $this->selectedDay = Carbon::now();
    }

    public function addDay(): void
    {
        $this->selectedDay->addDay();
    }

    public function subDay(): void
    {
        $this->selectedDay->subDay();
    }

    #[On('dateSelected')]
    public function setDate($date): void
    {
        $this->selectedDay = Carbon::parse($date);
    }
}
