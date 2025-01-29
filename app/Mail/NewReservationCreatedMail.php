<?php

namespace App\Mail;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewReservationCreatedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public Reservation $reservation,
        public User $user
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Přibyla nová rezervace od uživatele: '.$this->user->email,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.new-reservation-created',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
