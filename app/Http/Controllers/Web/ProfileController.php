<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ChangePasswordRequest;
use App\Http\Requests\Web\UpdateProfileInformationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        return view('web.user.profile');
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
        return view('web.user.my-reservations');
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
}
