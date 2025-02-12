<?php

namespace App\Http\Middleware\Web;

use Closure;
use Illuminate\Http\Request;

class IsMemberOfLeagueMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        if (is_null(user()->leagues->first())) {
            abort(403, 'Nejste členem vybrané ligy. Nemáte do ní přístup!');
        }

        return $next($request);
    }
}
