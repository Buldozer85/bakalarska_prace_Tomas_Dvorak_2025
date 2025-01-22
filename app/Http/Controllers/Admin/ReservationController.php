<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateReservationRequest;
use App\Models\Reservation;
use App\Notifications\ReservationCancelledNotification;
use App\Notifications\ReservationConfirmedNotification;
use App\Notifications\ReservationUnConfirmedNotification;
use Illuminate\Http\RedirectResponse;

class ReservationController extends Controller
{
    public function index()
    {
        return view('admin.reservations.index');
    }

    public function detail(Reservation $reservation)
    {
        return view('admin.reservations.detail')->with(['reservation' => $reservation]);
    }

    public function update(UpdateReservationRequest $request, Reservation $reservation): RedirectResponse
    {
        $reservation->on_company = $request->get('on_company') ?? false;
        $reservation->type = $request->get('reservation_type');

        $reservation->address->street = $request->get('street');
        $reservation->address->number = $request->get('number');
        $reservation->address->town = $request->get('town');
        $reservation->address->postcode = $request->get('postcode');
        $reservation->address->country = config('app.country');
        $reservation->address->save();

        $reservation->customerInformation->first_name = $request->get('first_name');
        $reservation->customerInformation->last_name = $request->get('last_name');
        $reservation->customerInformation->phone = $request->get('phone');
        $reservation->customerInformation->email = $request->get('email');
        $reservation->customerInformation->save();

        if ($reservation->on_company) {
            $reservation->companyData->company_name = $request->get('company_name');
            $reservation->companyData->company_address = $request->get('company_address');
            $reservation->companyData->ICO = $request->get('ico');
            $reservation->companyData->save();
        }

        $reservation->save();

        flash('Rezervace byla upravena');

        return redirect()->back();

    }

    public function cancelReservation(Reservation $reservation): RedirectResponse
    {
        $reservation->cancelled = now();
        $reservation->confirmed = null;
        $reservation->save();
        flash('Rezervace byla zrušena');
        $reservation->user->notify(new ReservationCancelledNotification($reservation));

        return redirect()->back();
    }

    public function confirmReservation(Reservation $reservation): RedirectResponse
    {
        $reservation->confirmed = now();
        $reservation->save();
        flash('Rezervace byla potvrzena');
        $reservation->user->notify(new ReservationConfirmedNotification($reservation));

        return redirect()->back();
    }

    public function unConfirmReservation(Reservation $reservation): RedirectResponse
    {
        $reservation->confirmed = null;
        $reservation->save();
        flash('Rezervace byla navrácena do stavu zpracování');
        $reservation->user->notify(new ReservationUnconfirmedNotification($reservation));

        return redirect()->back();
    }
}
