<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateLeagueRequest;
use App\Models\League;
use Carbon\Carbon;

class LeagueController extends Controller
{
    public function index()
    {
        return view('admin.league.index');
    }

    public function detail(League $league)
    {
        return view('admin.league.detail')->with(['league' => $league]);
    }

    public function showCreate()
    {
        return view('admin.league.create');
    }

    public function create(CreateLeagueRequest $request)
    {
        $start = Carbon::parse($request->get('start'));

        if ($start->lt(Carbon::now()->setTime(0, 0))) {
            return redirect()->back()->withErrors(['start' => 'Zadané datum nesmí být v minulosti'])->withInput();
        }

        $end = null;

        if (! is_null($request->get('end'))) {
            $end = Carbon::parse($request->get('end'));

            if ($end->lt(Carbon::now())) {
                return redirect()->back()->withErrors(['end' => 'Zadané datum nesmí být v minulosti'])->withInput();
            }
        }

        if ($request->get('year') < now()->year) {
            return redirect()->back()->withErrors(['year' => 'Zadaný rok nesmí být v minulosti'])->withInput();
        }

        if ($request->get('year') != $start->year) {
            return redirect()->back()->withErrors(['year' => 'Zadaný rok musí být v souladu s datem začátku'])->withInput();
        }

        $league = new League;
        $league->name = $request->get('name');
        $league->start = $start;
        $league->end = $end;
        $league->description = $request->get('description');
        $league->year = $request->get('year');
        $league->save();

        flash('Liga byla vytvořena');

        return redirect()->route('administration.league.detail', $league->id);
    }
}
