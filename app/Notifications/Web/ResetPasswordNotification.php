<?php

namespace App\Notifications\Web;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public string $url
    ) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Upozornění na resetování hesla')
            ->greeting('Dobrý den, ')
            ->line('zasíláme Vám tuto zprávu, jelikož jsme přijali požadavek na resetování hesla k Vašemu účtu. ')
            ->action('Reset hesla', $this->url)
            ->line('Odkaz je platný 60 min po vytvoření požadavku.')
            ->line('Pokud jste o resetování hesla nežádali, můžete tuto zprávu ignorovat.')
            ->salutation('S pozdravem, ')
            ->salutation('Tým Kuželny Veselí');
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
