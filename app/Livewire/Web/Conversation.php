<?php

namespace App\Livewire\Web;

use App\Mail\MessageReceivedMail;
use App\Models\Conversation as ConversationModel;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class Conversation extends Component
{
    use WithPagination;

    public string $message = '';

    public ?ConversationModel $conversation;

    public function mount(): void
    {
        $this->conversation = user()->conversations->first() ?? new ConversationModel;
    }

    public function render()
    {
        $messages = $this->conversation->messages()->latest()->paginate(6);
        $messagesLinks = $messages->links();

        return view('livewire.web.conversation')->with([
            'messages' => $messages->reverse(),
            'messagesLinks' => $messagesLinks,
        ]);
    }

    public function sendMessage(): void
    {
        if (empty($this->message)) {
            return;
        }

        if (is_null($this->conversation->id)) {
            $this->conversation->from_name = user()->full_name;
            $this->conversation->from_email = user()->email;
            $this->conversation->save();
        }

        $message = new Message;
        $message->message = $this->message;
        $message->conversation_id = $this->conversation->id;
        $message->sent = Carbon::now();
        $message->viewed = null;
        $message->sender_email = user()->email;
        $message->save();

        $this->message = '';

        $message = (new MessageReceivedMail($message))
            ->onQueue('messages');

        Mail::to(config('mail.from.address'))->queue($message);
    }
}
