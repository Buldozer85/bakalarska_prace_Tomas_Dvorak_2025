<?php

namespace App\Livewire\Web;

use App\Enums\ReservationStatus;
use App\Models\Reservation as ReservationModel;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class MyReservations extends Component
{
    use WithPagination;

    private ?ReservationModel $selectedReservation;

    public string $status = '';

    public string $orderBy = 'created_at';

    public string $direction = 'desc';

    public function render()
    {
        $reservations = user()
            ->reservations()
            ->when($this->status === ReservationStatus::CONFIRMED->value, function (Builder $query) {
                return $query->whereNotNull('confirmed');
            })
            ->when($this->status === ReservationStatus::CANCELLED->value, function (Builder $query) {
                return $query->whereNotNull('cancelled');
            })
            ->when($this->status === ReservationStatus::WAITING->value, function (Builder $query) {
                return $query->whereNull('confirmed')->whereNull('cancelled');
            })
            ->when(! empty($this->orderBy), function (Builder $query) {
                return $query->orderBy($this->orderBy, $this->direction);
            })

            ->paginate(10);

        return view('livewire.web.my-reservations')->with('reservations', $reservations);
    }

    public function updatedPage($page): void
    {
        $this->dispatch('page-updated');
    }

    public function cancelReservation(int $reservationId): void
    {
        $reservation = user()->reservations->find($reservationId);

        if (is_null($reservation->id)) {
            abort(404, 'Rezervace nenalezana');
        }

        $reservation->cancelled = now();
        $reservation->save();
    }

    public function resetFilters(): void
    {
        $this->status = '';
        $this->orderBy = 'created_at';
        $this->direction = 'desc';
        $this->dispatch('page-updated');
    }

    public function updated()
    {
        $this->dispatch('page-updated');
    }
}
