<?php

namespace App\Livewire\Web;

use Livewire\Component;

class MyReservations extends Component
{
    public int $selectedReservationId;

    public function render()
    {
        return view('livewire.web.my-reservations');
    }

    public function deleteReservation(): void
    {
        // TODO: Delete reservation
    }
}
