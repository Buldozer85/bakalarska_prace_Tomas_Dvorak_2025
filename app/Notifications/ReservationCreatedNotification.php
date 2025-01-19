<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationCreatedNotification extends Notification implements ShouldQueue
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
            ->subject('Souhrn rezervace')
            ->greeting('Souhrn rezervace #'.$this->reservation->id)
            ->line('Dobrý den,')
            ->line('Zasíláme Vám souhrn rezervace ze dne '.$this->reservation->created_at->format('j.n.Y'))
            ->line('Datum: '.$this->reservation->date->format('j.n.Y'))
            ->line('Od - Do: '.$this->reservation->from_to)
            ->line('Typ: '.$this->reservation->type->label())
            ->line('Jméno: '.$this->reservation->customerInformation->full_name)
            ->line('E-mail: '.$this->reservation->customerInformation->email)
            ->line('Telefon: '.$this->reservation->customerInformation->phone)
            ->lineIf($this->reservation->on_company, 'Název společnosti: '.$this->reservation->companyData?->company_name ?? '')
            ->lineIf($this->reservation->on_company, 'ICO:  '.$this->reservation->companyData?->ico ?? '')
            ->line('Adresa: '.$this->reservation->address->full_address)

            ->action('Zobrazit reservaci', route('profile.my-reservations'))

            ->salutation('S pozdravem Kuželna Veselí');

    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
