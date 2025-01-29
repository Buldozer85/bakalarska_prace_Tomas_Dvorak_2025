<?php

namespace App\Livewire\Web;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

/**
 * @deprecated
 */
class ReservationMobile extends Component
{
    #[Locked]
    public Carbon $selectedDay;

    #[Locked]
    public bool $readOnly;

    public Collection $reservations;

    public function render()
    {
        return view('livewire.web.reservation-mobile');
    }

    public function mount(?bool $readOnly)
    {
        $this->readOnly = $readOnly ?? false;
    }

    public function boot()
    {
        $this->reservations = \App\Models\Reservation::query()
            ->where('date', '=', $this->selectedDay->format('Y-m-d'))
            ->get();
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

    public function getTimeSlotStatus(Carbon $slot): string
    {
        $slot->setDateFrom($this->selectedDay);

        $dbReservation = $this->reservations->filter(function ($reservation) use ($slot) {
            return $reservation->slot_from <= $slot && $reservation->slot_to >= $slot;
        })->first();

        if (! is_null($dbReservation)) {
            return 'reserved';
        }

        if (round($slot->diffInDays(Carbon::now())) >= 0) {
            return 'unavailable';
        }

        return 'empty';
    }
}
