<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UpdateReservationRequest;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function success(Reservation $reservation): View
    {
        return view('web.reservation.success-page')->with(['reservation' => $reservation]);
    }

    public function updateReservation(UpdateReservationRequest $request, Reservation $reservation): RedirectResponse
    {
        $reservation->customerInformation->first_name = $request->get('first_name');
        $reservation->customerInformation->last_name = $request->get('last_name');
        $reservation->customerInformation->email = $request->get('email');
        $reservation->customerInformation->phone = $request->get('phone');
        $reservation->customerInformation->save();

        $reservation->address->street = $request->get('street');
        $reservation->address->number = $request->get('number');
        $reservation->address->postcode = $request->get('postcode');
        $reservation->address->town = $request->get('town');
        $reservation->address->save();

        if ($reservation->on_company) {
            $reservation->companyData->company_name = $request->get('company_name');
            $reservation->companyData->ICO = $request->get('ICO');
            $reservation->companyData->company_address = $request->get('company_address');
            $reservation->companyData->save();

        }
        $reservation->save();

        return redirect()->back();
    }

    public function cancel(Reservation $reservation)
    {
        $reservation->cancelled = now();
        $reservation->save();

        return redirect()->route('profile.my-reservations');
    }
}
