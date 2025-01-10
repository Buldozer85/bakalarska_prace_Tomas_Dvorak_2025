<?php

namespace App\Livewire\Admin;

use App\Models\Conversation as ConversationModel;
use App\Models\Message;
use App\Notifications\MessageSentNotification;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Conversation extends Component
{
    use WithPagination;

    public ConversationModel $conversation;

    public string $message = '';

    public function mount(ConversationModel $conversation): void
    {
        $this->conversation = $conversation;
    }

    public function render()
    {
        $messages = $this->conversation->messages->whereNull('viewed');

        foreach ($messages as $message) {
            $message->markAsViewed();
        }

        $messages = $this->conversation->messages()->latest()->paginate(6);
        $messagesLinks = $messages->links();

        return view('livewire.admin.conversation')->with([
            'messages' => $messages->reverse(),
            'messagesLinks' => $messagesLinks,
        ]);
    }

    public function sendMessage(): void
    {
        $message = new Message;

        $message->message = $this->message;
        $message->conversation_id = $this->conversation->id;
        $message->sent = Carbon::now();
        $message->sender_email = config('mail.from.address');
        $message->save();

        $this->message = '';

        $this->conversation->conversationStarterUser->notify(new MessageSentNotification($message));
    }
}
