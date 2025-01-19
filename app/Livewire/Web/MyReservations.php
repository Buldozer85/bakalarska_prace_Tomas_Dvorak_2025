<?php

namespace App\Livewire\Web;

use Livewire\Component;
use Livewire\WithPagination;

class MyReservations extends Component
{
    use WithPagination;

    public int $selectedReservationId;

    public function render()
    {
        $reservations = user()->latestReservations()->paginate(1);

        return view('livewire.web.my-reservations')->with('reservations', $reservations);
    }

    public function updatedPage($page): void
    {
        $this->dispatch('page-updated');
    }

    public function deleteReservation(): void
    {
        // TODO: Delete reservation
    }
}
