<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateReservationAreaRequest;
use App\Http\Requests\Admin\UpdateReservationAreaRequest;
use App\Models\ReservationArea;

class ReservationAreaController extends Controller
{
    public function index()
    {
        return view('admin.reservation_areas.index');
    }

    public function createPage()
    {
        return view('admin.reservation_areas.create');
    }

    public function updatePage(ReservationArea $reservationArea)
    {
        return view('admin.reservation_areas.detail')->with('reservationArea', $reservationArea);
    }

    public function create(CreateReservationAreaRequest $request)
    {
        $reservationArea = new ReservationArea;
        $reservationArea->name = $request->get('name');
        $reservationArea->is_active = $request->get('is_active');
        $reservationArea->key = $request->get('key');
        $reservationArea->save();

        flash('Reezrvační oblast byla úspěšně vytvořena');

        return redirect()->route('administration.reservationArea.updatePage', $reservationArea->id);
    }

    public function update(UpdateReservationAreaRequest $request, ReservationArea $reservationArea)
    {
        $reservationArea->name = $request->get('name');
        $reservationArea->is_active = $request->get('is_active');
        $reservationArea->key = $request->get('key');
        $reservationArea->save();

        flash('Rezervační oblast byla úspěšně upravena');

        return redirect()->route('administration.reservationArea.updatePage', $reservationArea->id);
    }
}
