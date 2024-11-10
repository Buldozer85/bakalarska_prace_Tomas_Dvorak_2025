<?php

namespace App\Livewire\Web;

use Carbon\Carbon;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Renderless;
use Livewire\Component;

class Reservation extends Component
{
    #[Locked]
    public Carbon $firstDayOfWeek;
    #[Locked]
    public Carbon $lastDayOfWeek;
    #[Locked]
    public Carbon $currentWeekFirstDay;
    protected String $selectedDate = '';
    #[Locked]
    public ?bool $readOnly;

    public ?string $backButtonAction;

    public function __construct()
    {
        $this->firstDayOfWeek =  Carbon::now()->startOfWeek();
        $this->lastDayOfWeek =  Carbon::now()->endOfWeek();
        $this->currentWeekFirstDay = Carbon::now();

    }

    public function mount(?bool $readOnly, ?string $backButtonAction = null)
    {
     $this->readOnly = $readOnly ?? false;
     $this->backButtonAction = $backButtonAction;
    }

    public function render()
    {
        return view('livewire.web.reservation');
    }

    public function increaseWeek(): void
    {
        $this->firstDayOfWeek->addWeek();
        $this->lastDayOfWeek = $this->firstDayOfWeek->copy()->endOfWeek();
    }

    public function decreaseWeek(): void
    {
        if(inPast($this->firstDayOfWeek, $this->currentWeekFirstDay)) {
            return;
        }

        $this->firstDayOfWeek->subWeek();
        $this->lastDayOfWeek = $this->firstDayOfWeek->copy()->endOfWeek();
    }

    #[On('dateSelected')]
    public function setDate($date): void
    {
        $this->firstDayOfWeek = Carbon::parse($date)->startOfWeek();
        $this->lastDayOfWeek = $this->firstDayOfWeek->copy()->endOfWeek();
        $this->selectedDate = $date;
    }
}
