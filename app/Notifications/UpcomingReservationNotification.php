<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpcomingReservationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Reservation $reservation) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nachystejte koule! Rezervace je blízko')
            ->greeting('Blíží se termín Vaší rezervace')
            ->line('Rezervace na den: '.$this->reservation->date->format('j. n. Y'))
            ->line('Od - Do: '.$this->reservation->from_to)
            ->action('Zobrazit detaily', route('profile.my-reservations.my-reservation', $this->reservation->id))
            ->salutation('S přáním hezkého dne '.config('app.name'));
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
