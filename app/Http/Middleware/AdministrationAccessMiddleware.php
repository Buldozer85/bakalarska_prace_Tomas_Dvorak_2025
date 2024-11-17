<?php

namespace App\Http\Middleware;

use App\Enums\Roles;
use Closure;
use Illuminate\Http\Request;

class AdministrationAccessMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (is_null(user())) {
            return redirect()->route('administration.login-page');
        }

        if (user()->role == Roles::USER) {
            abort(403);
        }

        return $next($request);
    }
}
