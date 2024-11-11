<?php

namespace App\Livewire\Web;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
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

    #[Layout('components.web.layouts.app')]
    #[Title('Vytvoření rezervace')]
    public function render()
    {
        return view('livewire.web.make-reservation');
    }

    public function mount()
    {
        $this->reservationTimes = new Collection;
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
}
