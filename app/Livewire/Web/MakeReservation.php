<?php

namespace App\Livewire\Web;

use App\Models\ReservationArea;
use App\Models\ReservationTemp;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class MakeReservation extends Component
{
    public int $selectedStep = 1;

    #[Validate('string|required', message: ['required' => 'Jméno je povinné', 'string' => 'Jméno musí být řetězec'])]
    public string $first_name;

    #[Validate('string|required', message: ['required' => 'Příjmení je povinné', 'string' => 'Jméno musí být řetězec'])]
    public string $last_name;

    #[Validate('email|required', message: ['required' => 'E-mail je povinný', 'email' => 'Zadali jste e-mail v nesprávném formátu'])]
    public string $email;

    #[Validate('string|required', message: ['required' => 'Telefon je povinný', 'string' => 'Telefon musí být řetězec'])]
    public string $phone;

    #[Validate('bool|nullable', message: ['bool' => 'Hodnota na firmu musí být pravda nebo nepravda'])]
    public ?bool $on_company = false;

    #[Validate('required_with:on_company|string', message: ['required_with' => 'Jméno firmy je povinné', 'string' => 'Jméno firmy musí být textový řetězec'])]
    public ?string $company_name;

    #[Validate('required_with:on_company|string', message: ['required_with' => 'Sídlo firmy je povinné', 'string' => 'Sídlo firmy musí být textový řetězec'])]
    public ?string $company_address;

    #[Validate('required_with:on_company|string', message: ['required_with' => 'IČO firmy je povinné', 'string' => 'IČO firmy musí být textový řetězec'])]
    public ?string $ico;

    #[Validate('string', message: ['string' => 'Poznámka musí být textový řetězec'])]
    public ?string $note = '';

    public mixed $reservation_type;

    public ?Carbon $reservation_date = null;

    public Collection $reservationTimes;

    #[Locked]
    public Carbon $firstDayOfWeek;

    #[Locked]
    public Carbon $lastDayOfWeek;

    #[Locked]
    public Carbon $currentWeekFirstDay;

    protected string $selectedDate = '';

    #[Locked]
    public ?bool $readOnly;

    public ?string $backButtonAction;

    public ?Carbon $reservationTemporaryEndDate = null;

    #[Layout('components.web.layouts.app')]
    #[Title('Vytvoření rezervace')]
    public function render()
    {
        return view('livewire.web.make-reservation');
    }

    public function mount(?bool $readOnly, ?string $backButtonAction = null)
    {
        $this->reservationTimes = new Collection;
        $this->readOnly = $readOnly ?? false;
        $this->backButtonAction = $backButtonAction;
        if (! is_null(user()->temporaryReservation)) {
            $tmpReservation = user()->temporaryReservation;
            $this->reservationTemporaryEndDate = $tmpReservation->created_at->addMinutes(15);
            $this->reservation_date = $tmpReservation->date;

            for ($i = $tmpReservation->slot_from->hour; $i < $tmpReservation->slot_to->hour; $i++) {
                $this->reservationTimes->add($this->reservation_date->copy()->hour($i)->minutes(0));
            }
            $this->reservationTimes = $this->reservationTimes->sortBy(fn ($time1) => $time1);
            $this->dispatch('start-timer')->to(Summary::class);
        }

    }

    public function __construct()
    {
        $this->firstDayOfWeek = Carbon::now()->startOfWeek();
        $this->lastDayOfWeek = Carbon::now()->endOfWeek();
        $this->currentWeekFirstDay = Carbon::now();

    }

    public function getSelectedStep(): int
    {
        return $this->selectedStep;
    }

    public function setSelectedStep(int $selectedStep): void
    {
        if ($selectedStep === 3) {
            if (! $this->canGoToSummary()) {
                return; // TODO: Zde bude ještě flash message, který vyvolá toast a řekne uživateli, že je potřeba vše vyplnit
            }
        }

        $this->selectedStep = $selectedStep;
    }

    public function nextStep(): void
    {
        if ($this->selectedStep + 1 === 3) {
            if (! $this->canGoToSummary()) {
                return;
            }
        }
        $this->selectedStep++;
    }

    #[On('backButtonTriggered')]
    public function previousStep(): void
    {
        if ($this->selectedStep === 1) {
            return;
        }

        $this->selectedStep--;
    }

    public function fullName(): string
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function is_on_company(): string
    {
        return $this->on_company ? 'Ano' : 'Ne';
    }

    public function canGoToSummary(): bool
    {
        return true;
        $company = true;

        if ($this->on_company) {
            $company = isset($this->company_name) && isset($this->company_address) && isset($this->ico);
        }

        return isset($this->first_name) &&
            isset($this->last_name) &&
            isset($this->email) &&
            isset($this->phone) &&
            isset($this->reservation_type) &&
            ! empty($this->reservationTimes) &&
            ! is_null($this->reservation_date) &&
          $company;

    }

    public function increaseWeek(): void
    {
        $this->firstDayOfWeek->addWeek();
        $this->lastDayOfWeek = $this->firstDayOfWeek->copy()->endOfWeek();
    }

    public function decreaseWeek(): void
    {
        if (inPast($this->firstDayOfWeek, $this->currentWeekFirstDay)) {
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

    public function addTime(string $time): void
    {
        $time = Carbon::parse($time);
        if (is_null($this->reservation_date) || round($this->reservation_date->diffInDays($time)) > 0) {
            $this->reservationTimes = collect();
            $this->reservation_date = $time->copy();
        }

        if (! $this->reservationTimes->contains($time)) {
            $this->reservationTimes->add($time);
        } else {

            $this->reservationTimes->forget($this->reservationTimes->search($time));
        }

        $this->reservationTimes = $this->reservationTimes->sortBy(fn ($time1) => $time1);

        $tmp = user()->temporaryReservation;

        if (is_null($tmp)) {
            $tmp = new ReservationTemp;
        }

        $tmp->slot_from = $this->reservationTimes->first();
        $tmp->slot_to = $this->reservationTimes->last();
        $tmp->slot_to = $tmp->slot_to->addHour();
        $tmp->date = $this->reservation_date;
        $tmp->user_id = user()->id;
        $tmp->reservation_area_id = ReservationArea::first()->id; // TODO: Complete ID of reservation area. It is for general purpose. For this app. It is enough
        $tmp->save();

        $this->reservationTemporaryEndDate = $tmp->created_at->addMinutes(15);
        $this->dispatch('start-timer')->to(Summary::class);
    }

    public function getRemainingReservationTime()
    {
        $decimalMinutes = abs($this->reservationTemporaryStartDate->diffInMinutes(Carbon::now()));
        $minutes = floor($decimalMinutes);
        $seconds = round(($decimalMinutes - $minutes) * 60);

        return Carbon::now()->minutes($minutes)->second($seconds);
    }
}
