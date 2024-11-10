<?php

namespace App\Livewire\Web;

use Carbon\Carbon;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\On;
use Livewire\Attributes\Renderless;
use Livewire\Component;

class DatePicker extends Component
{
    public Carbon $selectDate;
    public Carbon $date;
    public Carbon $firstDayOfCalendar;



    public function __construct()
    {
        $this->date = Carbon::now();
        $this->selectDate = $this->date->copy();
        $firstDayOfMonth = Carbon::now()->startOfMonth();
        $this->firstDayOfCalendar = $firstDayOfMonth->subDays($firstDayOfMonth->dayOfWeekIso - 1);

    }

    public function render()
    {
        return view('livewire.web.date-picker');
    }

    public function label(): string
    {
        return month($this->date->month - 1) . ' ' . $this->date->year;
    }


    public function addMonth(): void
    {
        $this->date->addMonth();

        $this->setFirstDayOfCalendar();
    }

    public function decreaseMonth(): void
    {
        if($this->pastMonth($this->date->copy()->subMonth(), Carbon::now())) {
            return;
        }
        $this->date->subMonth();
        $this->firstDayOfCalendar->subMonth();
        $this->setFirstDayOfCalendar();
    }
    #[Renderless]
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


    #[Renderless]
    protected function setFirstDayOfCalendar(): void
    {
        $firstDayOfMonth = $this->date->copy()->firstOfMonth();

        $this->firstDayOfCalendar = $firstDayOfMonth->subDays($firstDayOfMonth->dayOfWeekIso - 1);
    }

    #[Renderless]
    public function setDate($date): void
    {
        $this->selectDate = Carbon::parse($date);
    }

    public function pastMonth(Carbon $date1, Carbon $date2): bool
    {
        return $date1->month < $date2->month && $date2->year >= $date1->year;
    }

    public function resetDate(): void
    {
        $this->reset();
    }


}
