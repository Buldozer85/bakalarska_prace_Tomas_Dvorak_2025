<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ChangePasswordRequest;
use App\Http\Requests\Web\UpdateProfileInformationRequest;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        $upcomingReservations = user()->upcomingReservations;

        $today = now();

        return view('web.user.profile')->with([
            'upcomingReservations' => $upcomingReservations->take(5),
            'reservationCount' => $upcomingReservations->count(),
            'today' => $today,
        ]);
    }

    public function editInformation(): View
    {
        return view('web.user.edit-information');
    }

    public function editPassword(): View
    {
        return view('web.user.edit-password');
    }

    public function myReservations(): View
    {
        return view('web.user.reservations.my-reservations');
    }

    public function myReservation(Reservation $reservation): View
    {
        $reservation = Reservation::query()
            ->with('address')
            ->with('customerInformation')
            ->with('companyData')
            ->with('documents')
            ->findOrFail($reservation->id);

        return view('web.user.reservations.detail')->with(['reservation' => $reservation]);
    }

    public function myLeague(): View
    {
        return view('web.user.my-league');
    }

    public function changeInformation(UpdateProfileInformationRequest $request): RedirectResponse
    {
        $user = user();

        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->phone = $request->get('phone');

        $user->save();

        return redirect()->back();
    }

    public function changePassword(ChangePasswordRequest $request): RedirectResponse
    {
        $user = user();
        $user->password = Hash::make($request->get('password'));
        $user->save();

        return redirect()->back();
    }

    public function conversations()
    {
        return view('web.user.conversations.detail');
    }
}
