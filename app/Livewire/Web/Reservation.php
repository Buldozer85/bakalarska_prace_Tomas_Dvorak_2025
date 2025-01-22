<?php

namespace App\Livewire\Web;

use App\Models\Reservation as ReservationModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class Reservation extends Component
{
    #[Locked]
    public Carbon $firstDayOfWeek;

    #[Locked]
    public Carbon $lastDayOfWeek;

    #[Locked]
    public Carbon $currentWeekFirstDay;

    public string $selectedDate = '';

    #[Locked]
    public ?bool $readOnly;

    public ?string $backButtonAction;

    public bool $showCreateButton;

    private ?Collection $reservations;

    #[Locked]
    public Carbon $selectedDay;

    public function __construct()
    {
        $this->firstDayOfWeek = Carbon::now()->startOfWeek();
        $this->lastDayOfWeek = Carbon::now()->endOfWeek();
        $this->currentWeekFirstDay = Carbon::now();
        $this->selectedDay = Carbon::now();

    }

    public function mount(?bool $readOnly, ?string $backButtonAction = null, bool $showCreateButton = true): void
    {
        $this->readOnly = $readOnly ?? false;
        $this->backButtonAction = $backButtonAction;
        $this->showCreateButton = $showCreateButton;

        $this->reservations = ReservationModel::unCancelled()->where(function (Builder $query) {
            $query->where('date', '>=', $this->firstDayOfWeek)->where('date', '<=', $this->lastDayOfWeek);
        })->get();
    }

    public function render()
    {
        return view('livewire.web.reservation');
    }

    public function addDay(): void
    {
        $this->selectedDay->addDay();

        if ($this->firstDayOfWeek->diffInDays($this->selectedDay->copy()->startOfWeek()) >= 7) {
            $this->firstDayOfWeek->addWeek();
            $this->lastDayOfWeek = $this->firstDayOfWeek->copy()->endOfWeek();

        }
        $this->updateReservations();

        $this->dispatch('date-changed', time: $this->selectedDay->format('j.n.Y'))->to(DatePicker::class);
    }

    public function subDay(): void
    {
        $this->selectedDay->subDay();

        if ($this->selectedDay->copy()->startOfWeek()->diffInDays($this->firstDayOfWeek) >= 7) {
            $this->firstDayOfWeek->subWeek();
            $this->lastDayOfWeek = $this->firstDayOfWeek->copy()->endOfWeek();
        }
        $this->updateReservations();
        $this->dispatch('date-changed', time: $this->selectedDay->format('j.n.Y'))->to(DatePicker::class);
    }

    public function increaseWeek(): void
    {
        $this->firstDayOfWeek->addWeek();
        $this->lastDayOfWeek = $this->firstDayOfWeek->copy()->endOfWeek();
        $this->selectedDay = $this->firstDayOfWeek->copy();
        $this->selectedDate = $this->firstDayOfWeek->format('Y-m-d');
        $this->updateReservations();
        $this->dispatch('date-changed', time: $this->selectedDay->format('j.n.Y'))->to(DatePicker::class);
    }

    public function decreaseWeek(): void
    {
        if (inPast($this->firstDayOfWeek, $this->currentWeekFirstDay)) {
            return;
        }

        $this->firstDayOfWeek->subWeek();
        $this->lastDayOfWeek = $this->firstDayOfWeek->copy()->endOfWeek();

        if (round($this->currentWeekFirstDay->diffInDays($this->firstDayOfWeek)) < 0) {
            $this->selectedDay = $this->currentWeekFirstDay->copy();
            $this->selectedDate = $this->currentWeekFirstDay->copy()->format('Y-m-d');
        } else {
            $this->selectedDay = $this->firstDayOfWeek->copy();
            $this->selectedDate = $this->firstDayOfWeek->format('Y-m-d');
        }

        $this->updateReservations();
        $this->dispatch('date-changed', time: $this->selectedDay->format('j.n.Y'))->to(DatePicker::class);
    }

    #[On('dateSelected')]
    public function setDate($date): void
    {
        $this->firstDayOfWeek = Carbon::parse($date)->startOfWeek();
        $this->lastDayOfWeek = $this->firstDayOfWeek->copy()->endOfWeek();
        $this->selectedDate = $date;
        $this->updateReservations();
        $this->selectedDay = Carbon::parse($date);
    }

    public function getTimeSlotStatus(Carbon $slot): string
    {
        $dbReservation = $this->getReservationsAtTimeSlot($slot)->first();

        if (! is_null($dbReservation)) {
            return 'reserved';
        }

        if (round($slot->diffInDays(Carbon::now())) >= 0) {
            return 'unavailable';
        }

        return 'empty';
    }

    private function getReservationsAtTimeSlot(Carbon $slot): Collection
    {
        if (is_null($this->reservations)) {
            return collect();
        }

        return $this->reservations->filter(function (ReservationModel $reservation) use ($slot) {
            return floor($reservation->date->diffInDays($slot)) === 0.0 && $reservation->slot_from <= $slot && $reservation->slot_to >= $slot;
        });
    }

    private function updateReservations(): void
    {
        $this->reservations = ReservationModel::unCancelled()->where(function (Builder $query) {
            $query->where('date', '>=', $this->firstDayOfWeek)->where('date', '<=', $this->lastDayOfWeek);
        })->get();
    }
}
