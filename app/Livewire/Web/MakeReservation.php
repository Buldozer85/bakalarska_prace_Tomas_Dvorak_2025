<?php

namespace App\Livewire\Web;

use App\Enums\ReservationTypes;
use App\Mail\NewReservationCreatedMail;
use App\Models\Reservation as ReservationModel;
use App\Models\ReservationAddress;
use App\Models\ReservationArea;
use App\Models\ReservationCompanyData;
use App\Models\ReservationCustomerInformation;
use App\Models\ReservationTemp;
use App\Notifications\ReservationCreatedNotification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

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
    public ?string $note;

    #[Validate('string|required', message: ['required' => 'Ulice je povinná', 'string' => 'Ulice musí být řetězec'])]
    public string $street;

    #[Validate('string|required', message: ['required' => 'Město je povinné', 'string' => 'Město musí být řetězec'])]
    public string $town;

    #[Validate('string|required', message: ['required' => 'PSČ je povinné', 'string' => 'PSČ musí být řetězec'])]
    public string $postcode;

    public string $country = 'Česká republika';

    #[Validate('string|required', message: ['required' => 'Č.P. je povinné', 'string' => 'Č.P. musí být řetězec'])]
    public string $number;

    #[Validate('string|required|in:'.ReservationTypes::TRACK->value.','.ReservationTypes::AREAL_PLUS_TRACK->value, message: ['required' => 'Typ rezervace je povinný', 'string' => 'Typ rezervace musí být řetězec', 'in' => 'Zadaný typ rezervace neexistuje'])]
    public string $reservation_type;

    public bool $credentials_concern = false;

    #[Locked]
    public ?Carbon $reservation_date = null;

    #[Locked]
    public Collection $reservationTimes;

    public ?Collection $reservations = null;

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

    #[Locked]
    public Carbon $selectedDay;

    #[Layout('components.web.layouts.app')]
    #[Title('Vytvoření rezervace')]
    public function render()
    {
        return view('livewire.web.make-reservation');
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function mount(?bool $readOnly, ?string $backButtonAction = null): void
    {
        $this->firstDayOfWeek = Carbon::now()->startOfWeek();
        $this->lastDayOfWeek = Carbon::now()->endOfWeek();
        $this->currentWeekFirstDay = Carbon::now();

        $this->selectedDay = Carbon::now();

        $this->reservations = ReservationModel::unCancelled()->where(function (Builder $query) {
            $query->where('date', '>=', $this->firstDayOfWeek)->where('date', '<=', $this->lastDayOfWeek);
        })->get();

        $this->reservationTimes = new Collection;
        $this->readOnly = $readOnly ?? false;
        $this->backButtonAction = $backButtonAction;

        $this->first_name = session()->get('reservation.first_name', user()->first_name);
        $this->last_name = session()->get('reservation.last_name', user()->last_name);
        $this->phone = session()->get('reservation.phone', user()->phone);
        $this->email = session()->get('reservation.email', user()->email);
        $this->reservation_type = session()->get('reservation.reservation_type', ReservationTypes::TRACK->value);
        $this->note = session()->get('reservation.note', '');

        $this->on_company = session()->get('reservation.on_company', false);
        $this->company_name = session()->get('reservation.company_name', '');
        $this->company_address = session()->get('reservation.company_address', '');
        $this->ico = session()->get('reservation.ico', '');

        $this->street = session()->get('reservation.street', '');
        $this->town = session()->get('reservation.town', '');
        $this->postcode = session()->get('reservation.postcode', '');
        $this->country = session()->get('reservation.country', '');
        $this->number = session()->get('reservation.number', '');

        if (! is_null(user()->temporaryReservation)) {
            $tmpReservation = user()->temporaryReservation;
            $this->reservationTemporaryEndDate = $tmpReservation->created_at->addMinutes(15);
            $this->reservation_date = $tmpReservation->date;

            for ($i = $tmpReservation->slot_from->hour; $i <= $tmpReservation->slot_to->hour; $i++) {
                $this->reservationTimes->add($this->reservation_date->copy()->hour($i)->minutes(0));
            }
            $this->reservationTimes = $this->reservationTimes->sortBy(fn ($time1) => $time1);
            $this->dispatch('start-timer')->to(Summary::class);
        }

        if (session()->has('reservation.step') && ! is_null($this->reservationTimes->first())) {
            $this->selectedStep = session('reservation.step');
        } else {
            session()->put('reservation.step', 1);
        }
    }

    public function updated($property): void
    {
        if (! in_array($property, ['reservedTimes', 'reserved_date'])) {
            session()->put("reservation.$property", $this->{$property});
        }
    }

    public function getSelectedStep(): int
    {
        return $this->selectedStep;
    }

    public function setSelectedStep(int $selectedStep): void
    {
        if ($selectedStep === 3) {
            if (! $this->canGoToSummary()) {
                flash('Pro postoupení na další krok je třeba vyplnit všechny povinné údaje', 'warning');
            }
        }

        $this->selectedStep = $selectedStep;
        session()->put('reservation.step', $this->selectedStep);
    }

    public function nextStep(): void
    {
        if ($this->selectedStep + 1 === 3) {
            if (! $this->canGoToSummary()) {
                flash('Pro postoupení na další krok je třeba vyplnit všechny povinné údaje', 'warning');

                return;
            }
        }
        $this->selectedStep++;
        session()->put('reservation.step', $this->selectedStep);
        $this->reset('reservations');
    }

    #[On('backButtonTriggered')]
    public function previousStep(): void
    {
        if ($this->selectedStep === 1) {
            return;
        }

        $this->selectedStep--;
        session()->put('reservation.step', $this->selectedStep);
    }

    public function fullName(): string
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function is_on_company(): string
    {
        return $this->on_company ? 'Ano' : 'Ne';
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

    public function addTime(string $time): void
    {
        $time = Carbon::parse($time);

        $dbReservation = $this->getReservationsAtTimeSlot($time)->first();

        if (! is_null($dbReservation)) {
            return;
        }

        if (round($time->diffInDays(Carbon::now())) >= 0) {
            return;
        }

        if (is_null($this->reservation_date) || floor($this->reservation_date->diffInDays($time)) > 0) {
            $this->reservationTimes = collect();
            $this->reservation_date = $time->copy();
        }

        if (! $this->reservationTimes->contains($time)) {
            $this->fillReservationTimes($time);

        } else {
            $this->handleTimeSlotRemoving($time);
        }

        $this->reservationTimes = $this->reservationTimes->sortBy(fn ($time1) => $time1);

        $tmp = user()->temporaryReservation;

        if (is_null($tmp)) {
            $tmp = new ReservationTemp;
        }

        if (is_null($this->reservationTimes->first()) && ! is_null($tmp->id)) {
            $this->deleteSelectedReservation($tmp);

            return;
        }

        $tmp->slot_from = $this->reservationTimes->first();
        $tmp->slot_to = $this->reservationTimes->last();
        $tmp->date = $this->reservation_date;
        $tmp->user_id = user()->id;
        $tmp->reservation_area_id = ReservationArea::first()->id; // TODO: Complete ID of reservation area. It is for general purpose. For this app. It is enough
        $tmp->save();

        user()->refresh();

        $this->reservationTemporaryEndDate = $tmp->created_at->addMinutes(15);
        $this->dispatch('start-timer')->to(Summary::class);
    }

    public function getTimeSlotStatus(Carbon $slot): string
    {
        $dbReservation = $this->getReservationsAtTimeSlot($slot)->first();

        if (! is_null($dbReservation)) {
            return 'reserved';
        }

        if ($this->reservationTimes->contains($slot)) {
            return 'selected';
        }

        if (round($slot->diffInDays(Carbon::now())) >= 0) {
            return 'unavailable';
        }

        return 'empty';
    }

    public function deleteSelectedReservation(?ReservationTemp $tmp): void
    {
        if (is_null($tmp)) {
            return;
        }

        $tmp->delete();
        $this->reservationTemporaryEndDate = null;
        $this->reservation_date = null;
        $this->reservationTimes = collect();
        $this->resetSession();
    }

    public function confirmReservation(): void
    {
        if (! $this->credentials_concern) {
            flash('Po potvrzení rezervace je třeba potvrdit správnost svých údajů', 'warning');

            return;
        }

        $reservation = new ReservationModel;

        $reservation->user_id = user()->id;
        $reservation->reservation_area_id = ReservationArea::first()->id;
        $reservation->date = $this->reservation_date;
        $reservation->slot_from = $this->reservationTimes->first();
        $reservation->slot_to = $this->reservationTimes->last()->copy()->addHour();
        $reservation->note = $this->note;
        $reservation->type = $this->reservation_type;
        $reservation->with_areal = ($this->reservation_type == ReservationTypes::AREAL_PLUS_TRACK->value);
        $reservation->on_company = $this->on_company;
        $reservation->purpose_of_rent = '';
        $reservation->save();

        $reservationAddress = new ReservationAddress;
        $reservationAddress->reservation_id = $reservation->id;
        $reservationAddress->town = $this->town;
        $reservationAddress->street = $this->street;
        $reservationAddress->postcode = $this->postcode;
        $reservationAddress->country = config('app.country');
        $reservationAddress->number = $this->number;
        $reservationAddress->save();

        $reservationCustomerInformation = new ReservationCustomerInformation;
        $reservationCustomerInformation->reservation_id = $reservation->id;
        $reservationCustomerInformation->first_name = $this->first_name;
        $reservationCustomerInformation->last_name = $this->last_name;
        $reservationCustomerInformation->phone = $this->phone;
        $reservationCustomerInformation->email = $this->email;
        $reservationCustomerInformation->save();

        if ($this->on_company) {
            $companyData = new ReservationCompanyData;
            $companyData->reservation_id = $reservation->id;
            $companyData->company_name = $this->company_name;
            $companyData->ICO = $this->ico;
            $companyData->company_address = $this->company_address;
            $companyData->save();
        }

        $reservation->save();

        user()->notify(new ReservationCreatedNotification($reservation));
        Mail::to(config('mail.from.address', 'info@kuzelnaveseli.cz'))->send(new NewReservationCreatedMail($reservation, user()));

        $this->deleteSelectedReservation(user()->temporaryReservation);

        $this->redirectRoute('reservation.success-page', $reservation->id);

    }

    public function cancelReservation(): void
    {
        $this->deleteSelectedReservation(user()->temporaryReservation);
        flash('Rezervace byla zrušena', 'error');
        $this->redirectRoute('reservation.show-create');
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

    private function handleTimeSlotRemoving(Carbon $time): void
    {
        if ($this->reservationTimes->count() == 1) {
            $this->reservationTimes = collect();

            return;
        }

        if ($this->reservationTimes->first() == $time || $this->reservationTimes->last() == $time) {
            $this->reservationTimes->forget($this->reservationTimes->search($time));

            return;
        }

        $endDate = $this->reservationTimes->last();
        $time->addHour();

        $timesToForget = $this->reservationTimes->filter(function (Carbon $timeI) use ($time, $endDate) {
            return $timeI->between($time, $endDate);
        });

        foreach ($timesToForget as $timeToForget) {
            $this->reservationTimes->forget($this->reservationTimes->search($timeToForget));
        }

        $tmp = user()->temporaryReservation;
        $tmp->slot_to = $time;
        $tmp->save();
    }

    private function fillReservationTimes(Carbon $time): void
    {
        if ($this->reservationTimes->count() === 0) {
            $this->reservationTimes->add($time);

            return;
        }

        if (floor($this->reservationTimes->first()->diffInHours($time)) < 1) {
            return;
        }

        if ($this->reservationTimes->last()->diffInHours($time) > 1) {
            $tmpDate = $this->reservationTimes->last()->copy();

            for ($i = $tmpDate->hour + 1; $i < $time->hour; $i++) {
                $tmpDateHour = $tmpDate->copy()->hour($i)->minutes(0);

                $dbReservation = $this->getReservationsAtTimeSlot($tmpDateHour)->first();

                if (! is_null($dbReservation)) {
                    return;
                }

                $this->reservationTimes->add($tmpDateHour);
            }
        }

        $this->reservationTimes->add($time);

    }

    private function canGoToSummary(): bool
    {
        $company = true;

        if ($this->on_company) {
            $company = ! empty($this->company_name) && ! empty($this->company_address) && ! empty($this->ico);
        }

        return ! empty($this->first_name) &&
            ! empty($this->last_name) &&
            ! empty($this->email) &&
            ! empty($this->phone) &&
            ! empty($this->reservation_type) &&
            ! empty($this->street) &&
            ! empty($this->town) &&
            ! empty($this->postcode) &&
            ! empty($this->number) &&
            ! is_null($this->reservationTimes->first()) &&
            ! is_null($this->reservation_date) &&
            $company;
    }

    private function getReservationsAtTimeSlot(Carbon $slot): Collection
    {
        if (is_null($this->reservations)) {
            return collect();
        }

        return $this->reservations->filter(function (ReservationModel $reservation) use ($slot) {
            return floor($reservation->date->diffInDays($slot)) === 0.0 && $reservation->slot_from <= $slot && $reservation->slot_to > $slot;
        });
    }

    private function updateReservations(): void
    {
        $this->reservations = ReservationModel::unCancelled()->where(function (Builder $query) {
            $query->where('date', '>=', $this->firstDayOfWeek)->where('date', '<=', $this->lastDayOfWeek);
        })->get();
    }

    private function resetSession(): void
    {
        session()->forget([
            'reservation.first_name',
            'reservation.last_name',
            'reservation.phone',
            'reservation.email',
            'reservation.company_name',
            'reservation.company_address',
            'reservation.ico',
            'reservation.number',
            'reservation.date',
            'reservation.reservation_type',
            'reservation.note',
            'reservation.on_company',
            'reservation.street',
            'reservation.town',
            'reservation.postcode',
            'reservation.country',
            'reservation.number',
            'reservation.step',
        ]);
    }
}
