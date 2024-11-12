<?php

namespace App\Http\Middleware\Web;

use Closure;
use Illuminate\Http\Request;

class UnverifiedMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (is_null($request->user()->email_verified_at)) {
            return $next($request);
        }

        return redirect()->route('profile');

    }
}
