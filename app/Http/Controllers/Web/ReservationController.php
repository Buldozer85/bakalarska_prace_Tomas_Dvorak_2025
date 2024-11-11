<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function index() {}

    public function success(): View
    {
        return view('web.reservation.success-page');
    }
}
