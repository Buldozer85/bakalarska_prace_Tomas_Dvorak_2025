<?php

namespace App\Livewire\Admin;

use App\Models\Conversation as ConversationModel;
use App\Models\Message;
use Carbon\Carbon;
use Livewire\Component;

class Conversation extends Component
{
    public ConversationModel $conversation;

    public string $message = '';

    public function mount(ConversationModel $conversation): void
    {
        $this->conversation = $conversation;
    }

    public function render()
    {
        return view('livewire.admin.conversation');
    }

    public function sendMessage(): void
    {
        $message = new Message;

        $message->message = $this->message;
        $message->conversation_id = $this->conversation->id;
        $message->sent = Carbon::now();
        $message->sender_email = config('mail.from.address');
        $message->save();
    }
}
