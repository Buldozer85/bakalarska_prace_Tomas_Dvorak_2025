<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationConfirmedNotification extends Notification implements ShouldQueue
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
            ->subject('Potvzení rezervace na den '.$this->reservation->date->format('j. n. Y'))
            ->greeting('Dobrý den,')
            ->line('Potvrzujeme Vaši rezervaci na den '.$this->reservation->date->format('j. n. Y'))
            ->line('V čase: '.$this->reservation->from_to)
            ->action('Zobrazit rezervaci', route('profile.my-reservations.my-reservation', $this->reservation->id))
            ->line('Těšíme se na Vaši návštěvu!')
            ->salutation('S pozdravem '.config('app.name'));
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
