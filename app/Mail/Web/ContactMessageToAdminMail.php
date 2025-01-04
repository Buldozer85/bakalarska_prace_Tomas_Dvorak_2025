<?php

namespace App\Mail\Web;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessageToAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Message $message,
        public Conversation $conversation
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->message->sender_email, $this->conversation->from_name),
            replyTo: [new Address($this->message->sender_email, $this->conversation->from_name)],
            subject: 'Nový dotaz od: '.$this->conversation->from_name,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.web.contact-message-to-admin',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
