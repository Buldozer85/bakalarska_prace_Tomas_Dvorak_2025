<?php

namespace App\Mail\Web;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessageSentMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Message $message
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Shrnutí dotazu',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.web.contact-message-sent',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
