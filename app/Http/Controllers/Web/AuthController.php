<?php

namespace App\Http\Controllers\Web;

use App\Enums\Roles;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\LoginRequest;
use App\Http\Requests\Web\RegisterUserRequest;
use App\Http\Requests\Web\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function index(): View
    {
        return view('web.auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $user = User::query()
            ->where('email', $request->email)->first();

        if(is_null($user)) {
            return back()->withErrors(['email' => 'Uživatel s daným e-mailem neexistuje']);
        }

        if(!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Zadali jste nesprávné heslo']);
        }

        Auth::login($user);

        return redirect()->route('profile');

    }

    public function showRegistrationPage(): View
    {
        return view('web.auth.register');
    }

    public function register(RegisterUserRequest $request): RedirectResponse
    {
        $user = new User();

        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->phone = $request->get('phone');
        $user->role = Roles::USER;
        $user->save();

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('verification.notice');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('homepage');
    }

    public function verifyEmail(EmailVerificationRequest $request): RedirectResponse
    {
        $request->fulfill();

        return redirect('/');
    }

    public function sendVerificationEmail(Request $request): RedirectResponse
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Odkaz byl odeslán na Váš email');
    }

    public function verificationNotice(): View
    {
        return view('web.auth.email-verification');
    }

    public function forgotPasswordPage(): View
    {
        return view('web.auth.forgot-password');
    }

    public function sendResetPasswordEmail(Request $request): RedirectResponse
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => 'Odeslali jsme Vám e-mail s odkaz pro resetování hesla.'])
            : back()->withErrors(['email' => 'Uživatel s daným e-mailem neexistuje']);
    }

    public function resetPasswordPage(string $token): View
    {
        return view('web.auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(ResetPasswordRequest $request): RedirectResponse
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ]);

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('show-login-page')->with('status', 'Heslo bylo úspěšně změněno')
            : back()->withErrors(['email' => ['Při změně hesla došlo k chybě. Zkuste to prosím znovu.']]);
    }
}
