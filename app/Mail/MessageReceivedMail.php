<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MessageReceivedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public Message $message) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Přišla Vám nová zpráva',
        );
    }

    public function content(): Content
    {
        if ($this->message->sender_email != 'info@kuzelnaveseli.cz') {
            $url = route('administration.conversations.detail', $this->message->conversation->id);
            $heading = $this->message->conversation->from_email;
        } else {
            $url = route('profile.conversations');
            $heading = 'Administrátora';
        }

        return new Content(
            markdown: 'emails.message-received',
            with: [
                'heading' => $heading,
                'url' => $url,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
