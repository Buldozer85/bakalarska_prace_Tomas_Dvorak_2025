<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateLeagueRoundRequest;
use App\Http\Requests\Admin\UpdateLeagueRoundRequest;
use App\Models\League;
use App\Models\LeagueRound;
use Carbon\Carbon;

class LeagueRoundController extends Controller
{
    public function showCreate(League $league)
    {
        return view('admin.league.rounds.create')->with(['league' => $league]);
    }

    public function detail(League $league, LeagueRound $leagueRound)
    {
        return view('admin.league.rounds.detail')->with([
            'league' => $league,
            'leagueRound' => $leagueRound,
        ]);
    }

    public function create(CreateLeagueRoundRequest $request, League $league)
    {
        $from = Carbon::parse($request->get('from'));

        $to = Carbon::parse($request->get('to'));

        if ($from->lt($league->start) || $from->gt($league->end)) {
            return redirect()->back()->withErrors(['from' => 'Od musí být v časovém rozsahu ligy'])->withInput();
        }

        if ($to->lt($league->start) || $to->gt($league->end)) {
            return redirect()->back()->withErrors(['to' => 'Do musí být v časovém rozsahu ligy'])->withInput();
        }

        $round = new LeagueRound;
        $round->league_id = $league->id;
        $round->to = $to;
        $round->from = $from;
        $round->number = $request->get('number');
        $round->is_finished = false;
        $round->save();

        return redirect()->route('administration.league.round.detail', ['league' => $league->id, 'leagueRound' => $round->id]);
    }

    public function update(UpdateLeagueRoundRequest $request, League $league, LeagueRound $leagueRound)
    {
        $from = Carbon::parse($request->get('from'));

        $to = Carbon::parse($request->get('to'));

        if ($from->lt($league->start) || $from->gt($league->end)) {
            return redirect()->back()->withErrors(['from' => 'Od musí být v časovém rozsahu ligy'])->withInput();
        }

        if ($to->lt($league->start) || $to->gt($league->end)) {
            return redirect()->back()->withErrors(['to' => 'Do musí být v časovém rozsahu ligy'])->withInput();
        }

        $leagueRound->to = $to;
        $leagueRound->from = $from;
        $leagueRound->number = $request->get('number');
        $leagueRound->is_finished = false;
        $leagueRound->save();

        flash('Kolo bylo upraveno');

        return redirect()->route('administration.league.round.detail', ['league' => $league->id, 'leagueRound' => $leagueRound->id]);
    }
}
