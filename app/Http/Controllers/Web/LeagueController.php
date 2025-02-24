<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\League;

class LeagueController extends Controller
{
    public function detail(League $league)
    {
        return view('web.user.leagues.detail')->with(['league' => $league]);
    }
}
