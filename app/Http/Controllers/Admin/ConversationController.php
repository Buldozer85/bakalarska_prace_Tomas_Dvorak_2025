<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use Carbon\Carbon;

class ConversationController extends Controller
{
    public function index()
    {
        return view('admin.conversations.index');
    }

    public function detail(Conversation $conversation)
    {
        $unseen = $conversation->unseenMessages;

        foreach ($unseen as $unseenMessage) {
            $unseenMessage->viewed = Carbon::now();
            $unseenMessage->save();
        }

        return view('admin.conversations.detail')->with(['conversation' => $conversation]);
    }
}
