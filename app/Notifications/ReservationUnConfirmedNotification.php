<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationUnConfirmedNotification extends Notification implements ShouldQueue
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
            ->subject('Stav Vaší rezervace byl změněn zpět na čeká na zpracování')
            ->greeting('Dobrý den,')
            ->line('Vaše rezervace na den '.$this->reservation->date->format('j. n. Y').' v čase: '.$this->reservation->from_to.' byla správcem přesunuta zpět do stavu zpracovávání')
            ->line('Pokud máte nějaké dotazy, kontaktujte správce')
            ->action('Zobrazit rezervaci', route('profile.my-reservations.my-reservation', $this->reservation->id))
            ->salutation('S pozdravem '.config('app.name'));
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
