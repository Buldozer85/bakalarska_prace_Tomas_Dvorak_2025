<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    public function index()
    {
        return view('admin.reservations.index');
    }
}
