<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserProfileRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Http\Requests\Admin\UserAddressRequest;
use App\Models\User;
use App\Models\UserAddress;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function detail(User $user)
    {
        return view('admin.users.detail')->with('user', $user);
    }

    public function update(User $user, UpdateUserRequest $request): RedirectResponse
    {
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->role = $request->get('role');
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email_verified_at = $request->get('email_verified_at') == 0 ? null : Carbon::now()->toDateTimeString();

        if (! is_null($request->get('password'))) {
            $user->password = Hash::make($request->get('password'));
        }

        $user->save() ? flash('Uživatel byl úspěšně upraven') : flash('Vyskytla se chyba, zkuste to prosím znovu', 'error');

        return redirect()->back();
    }

    public function createPage()
    {
        return view('admin.users.create');
    }

    public function create(CreateUserRequest $request): RedirectResponse
    {
        $user = new User;
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->role = $request->get('role');
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->phone = $request->get('phone');
        $user->email_verified_at = $request->get('email_verified_at') == 0 ? null : Carbon::now()->toDateTimeString();

        $user->save() ? flash('Uživatel byl úspěšně vytvořen') : flash('Vyskytla se chyba, zkuste to prosím znovu', 'error');

        return redirect()->route('administration.users.user.detail', $user->id);
    }

    public function delete(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->to(route('administration.users.index'));
    }

    public function profile()
    {
        return view('admin.user.profile');
    }

    public function createAddress(UserAddressRequest $request, User $user): RedirectResponse
    {
        $address = new UserAddress;

        $address->user_id = $user->id;
        $address->street = $request->get('street');
        $address->number = $request->get('number');
        $address->postcode = $request->get('postcode');
        $address->town = $request->get('town');
        $address->country = $request->get('country');
        $address->save();

        $address->save() ? flash('Adresa byla úspěšně vytvořena') : flash('Vyskytla se chyba, zkuste to prosím znovu', 'error');

        return redirect()->route('administration.users.user.detail', $user->id);
    }

    public function updateAddress(UserAddressRequest $request, User $user): RedirectResponse
    {
        $user->address->street = $request->get('street');
        $user->address->number = $request->get('number');
        $user->address->postcode = $request->get('postcode');
        $user->address->town = $request->get('town');
        $user->address->country = $request->get('country');
        $user->address->save();

        $user->address->save() ? flash('Adresa byla úspěšně upravena') : flash('Vyskytla se chyba, zkuste to prosím znovu', 'error');

        return redirect()->route('administration.users.user.detail', $user->id);
    }

    public function updateProfile(UpdateUserProfileRequest $request)
    {
        user()->email = $request->get('email');
        user()->first_name = $request->get('first_name');
        user()->last_name = $request->get('last_name');
        user()->phone = $request->get('phone');

        if (! is_null($request->get('password'))) {
            user()->password = Hash::make($request->get('password'));
        }

        user()->save() ? flash('Vaše údaje byly úspěšně upraveny') : flash('Vyskytla se chyba, zkuste to prosím znovu', 'error');

        return redirect()->route('administration.user.profile');
    }

    public function updateProfileAddress(UserAddressRequest $request): RedirectResponse
    {
        user()->address->street = $request->get('street');
        user()->address->number = $request->get('number');
        user()->address->postcode = $request->get('postcode');
        user()->address->town = $request->get('town');
        user()->address->country = $request->get('country');

        user()->address->save() ? flash('Vaše adresa byla úspěšně upravena') : flash('Vyskytla se chyba, zkuste to prosím znovu', 'error');

        return redirect()->route('administration.user.profile');
    }

    public function createProfileAddress(UserAddressRequest $request): RedirectResponse
    {
        $address = new UserAddress;
        $address->street = $request->get('street');
        $address->number = $request->get('number');
        $address->postcode = $request->get('postcode');
        $address->town = $request->get('town');
        $address->country = $request->get('country');
        $address->user_id = user()->id;

        $address->save() ? flash('Vaše adresa byla úspěšně přidána') : flash('Vyskytla se chyba, zkuste to prosím znovu', 'error');

        return redirect()->route('administration.user.profile');
    }
}
