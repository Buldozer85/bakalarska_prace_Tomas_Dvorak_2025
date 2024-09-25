<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index()
    {
        return view('web.index', ['title' => 'Hlavní strana']);
    }

    public function contact()
    {
        return view('web.contact', ['title' => 'Kontakt']);
    }
}
