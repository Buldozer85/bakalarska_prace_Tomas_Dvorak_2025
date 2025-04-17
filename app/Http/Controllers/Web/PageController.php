<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(): View
    {
        return view('web.index', ['title' => 'Hlavní strana']);
    }

    public function contact(): View
    {
        return view('web.contact', ['title' => 'Kontakt']);
    }

    public function reservation(): View
    {
        return view('web.reservation');
    }

    public function league(): View
    {
        return view('web.league');
    }

    public function aboutWeb(): View
    {
        return view('web.about-web');
    }
}
