<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationCancelledNotification extends Notification implements ShouldQueue
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
            ->subject('Zrušení rezervace')
            ->greeting('Dobrý den,')
            ->line('Vaše rezervace na den '.$this->reservation->date->format('j. n. Y').'v čase '.$this->reservation->from_to.' byla zrušena')
            ->line('Pokud si myslíte, že se jedná o chybu. Kontaktujte prosím správce Kuželny')
            ->action('Zobrazit rezervaci', route('profile.my-reservations.my-reservation', $this->reservation->id))
            ->greeting('S pozdravem '.config('app.name'));
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
