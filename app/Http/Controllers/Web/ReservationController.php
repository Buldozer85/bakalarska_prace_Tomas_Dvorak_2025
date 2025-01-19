<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function success(Reservation $reservation): View
    {
        return view('web.reservation.success-page')->with(['reservation' => $reservation]);
    }
}
