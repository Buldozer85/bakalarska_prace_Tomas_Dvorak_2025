<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
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

        $user->save();

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
        $user->save();

        return redirect()->route('administration.users.user.detail', $user->id);
    }

    public function delete(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->to(route('administration.users.index'));
    }

    public function profile()
    {
        return \view('admin.user.profile');
    }

    public function updateProfile() {}
}
