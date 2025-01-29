<?php

namespace App\Livewire\Web;

use Carbon\Carbon;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Renderless;
use Livewire\Component;

class DatePicker extends Component
{
    #[Reactive]
    public ?Carbon $selectDate;

    public Carbon $date;

    public Carbon $firstDayOfCalendar;

    public string $printDate = '';

    public function mount(): void
    {
        $this->date = $this->selectDate->copy();
        $firstDayOfMonth = $this->selectDate->copy()->startOfMonth();
        $this->firstDayOfCalendar = $firstDayOfMonth->subDays($firstDayOfMonth->dayOfWeekIso - 1);
    }

    public function boot()
    {
        $this->printDate = $this->selectDate->format('j.n.Y');
    }

    public function render()
    {
        return view('livewire.web.date-picker');
    }

    public function label(): string
    {
        return month($this->date->month - 1).' '.$this->date->year;
    }

    public function addMonth(): void
    {
        $this->date->firstOfMonth()->addMonth();

        $this->setFirstDayOfCalendar();

    }

    public function decreaseMonth(): void
    {
        if ($this->pastMonth($this->date->copy()->subMonth(), Carbon::now())) {
            return;
        }
        $this->date->firstOfMonth()->subMonth();

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
        return "{$this->firstDayOfCalendar->format('j.n.Y')}";
    }

    #[Renderless]
    protected function setFirstDayOfCalendar(): void
    {
        $firstDayOfMonth = $this->date->copy()->firstOfMonth();

        $this->firstDayOfCalendar = $firstDayOfMonth->subDays($firstDayOfMonth->dayOfWeekIso - 1);
    }

    public function setDate($date): void
    {
        $this->date = Carbon::parse($date);
        $this->printDate = $this->date->format('j.n.Y');
        $this->setFirstDayOfCalendar();
    }

    public function pastMonth(Carbon $date1, Carbon $date2): bool
    {
        return $date1->month < $date2->month && $date2->year >= $date1->year;
    }

    public function resetDate(): void
    {
        $this->date = $this->selectDate->copy();
        $this->printDate = $this->date->format('j.n.Y');
        $firstDayOfMonth = $this->selectDate->copy()->startOfMonth();
        $this->firstDayOfCalendar = $firstDayOfMonth->subDays($firstDayOfMonth->dayOfWeekIso - 1);
    }

    public function formatedSelectedDate(): string
    {
        return $this->selectDate->format('j.n.Y');
    }
}
