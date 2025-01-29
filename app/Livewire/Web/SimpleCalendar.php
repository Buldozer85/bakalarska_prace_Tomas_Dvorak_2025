<?php

namespace App\Livewire\Web;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class SimpleCalendar extends Component
{
    public Carbon $date;

    public Carbon $firstDayOfCalendar;

    public ?Collection $reservations = null;

    public function boot(): void
    {
        $this->date = Carbon::now();
        $this->setFirstDayOfCalendar();
    }

    public function render()
    {
        return view('livewire.web.simple-calendar');
    }

    public function label(): string
    {
        return month($this->date->month - 1).' '.$this->date->year;
    }

    public function addMonth(): void
    {
        $this->date->addMonth();
        $this->setFirstDayOfCalendar();
    }

    public function decreaseMonth(): void
    {
        $this->date->subMonth();
        $this->firstDayOfCalendar->subMonth();
        $this->setFirstDayOfCalendar();
    }

    public function printDay()
    {
        $day = $this->firstDayOfCalendar->day;

        $this->firstDayOfCalendar->addDay();

        return $day;

    }

    public function getFormattedDate(): string
    {
        return "{$this->firstDayOfCalendar->format('j')}.{$this->firstDayOfCalendar->format('n')}.{$this->firstDayOfCalendar->year}";
    }

    protected function setFirstDayOfCalendar(): void
    {
        $firstDayOfMonth = $this->date->copy()->firstOfMonth();

        $this->firstDayOfCalendar = $firstDayOfMonth->subDays($firstDayOfMonth->dayOfWeekIso - 1);
    }

    public function hasDate(): bool
    {
        if (is_null($this->reservations)) {
            return false;
        }

        return ! is_null($this->reservations->filter(function (\App\Models\Reservation $reservation) {
            return $reservation->date == $this->firstDayOfCalendar;
        })->first());
    }
}
