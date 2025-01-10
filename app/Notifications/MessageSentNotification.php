<?php

namespace App\Notifications;

use App\Mail\MessageReceivedMail;
use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification;

class MessageSentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private Message $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): Mailable
    {
        return (new MessageReceivedMail($this->message))->to($notifiable->email);
    }

    public function toArray(object $notifiable): array
    {
        return [];
    }

    public function viaQueues(): array
    {
        return [
            'mail' => 'messages',
        ];
    }
}
