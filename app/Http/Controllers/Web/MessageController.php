<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SendContactMessageRequest;
use App\Mail\Web\ContactMessageSentMail;
use App\Models\Conversation;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function send(SendContactMessageRequest $request)
    {
        $conversation = Conversation::query()->where('from_email', '=', $request->email)->first();

        if (is_null($conversation)) {
            $conversation = new Conversation;
            $conversation->from_email = $request->get('email');
            $conversation->from_name = $request->get('name');
            $conversation->save();
        }

        $message = new Message;
        $message->message = $request->get('message');
        $message->sent = Carbon::now();
        $message->conversation_id = $conversation->id;
        $message->sender_email = $conversation->from_email;

        $message->save();

        Mail::to($conversation->from_email)
            ->bcc(config('mail.from.address', 'info@kuzelnaveseli.cz'))
            ->queue(new ContactMessageSentMail($message));

    }
}
