<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Reservation;

class PageController extends Controller
{
    public function index()
    {
        $reservations = Reservation::unCancelled()
            ->whereNull('confirmed')
            ->where('date', '>', now())
            ->orderBy('created_at', 'DESC')
            ->get();

        $count = $reservations->count();

        $messages = Message::query()
            ->where('sender_email', '!=', config('mail.from.address'))
            ->whereNull('viewed')
            ->with('conversation')
            ->orderBy('sent', 'desc')
            ->get();

        return view('admin.dashboard')
            ->with([
                'reservations' => $reservations->take(5),
                'count' => $count,
                'messages' => $messages->take(5),
            ]);
    }
}
