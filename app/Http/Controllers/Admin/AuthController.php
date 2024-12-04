<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $user = User::query()
            ->where('email', $request->email)->first();

        if (is_null($user)) {
            return back()->withErrors(['email' => 'Uživatel s daným e-mailem neexistuje']);
        }

        if (! $user->is_admin) {
            abort(403);
        }

        if (! Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Zadali jste nesprávné heslo']);
        }

        Auth::login($user);

        return redirect()->route('administration.dashboard');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('administration.login-page');
    }
}
