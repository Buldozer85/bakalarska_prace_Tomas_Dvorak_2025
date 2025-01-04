<?php

namespace App\Livewire\Web;

use App\Mail\Web\ContactMessageSentMail;
use App\Mail\Web\ContactMessageToAdminMail;
use App\Models\Conversation;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ContactForm extends Component
{
    #[Validate('required|email', message: ['required' => 'E-mail je povinný', 'email' => 'Zadaný e-mail je ve špatném formátu'])]
    public string $email = '';

    #[Validate('required|string', message: ['required' => 'Zpráva je povinná', 'string' => 'Zpráva musí být řetězec'])]
    public string $message = '';

    #[Validate('string|required', message: ['required' => 'Jméno je povinné', 'string' => 'Jméno musí být řetězec'])]
    public string $name = '';

    public function render(): View
    {
        return view('livewire.web.contact-form');
    }

    public function send(): void
    {
        $this->validate();
        $conversation = Conversation::query()->where('from_email', '=', $this->email)->first();

        if (is_null($conversation)) {
            $conversation = new Conversation;
            $conversation->from_email = $this->email;
            $conversation->from_name = $this->name;
            $conversation->save();
        }

        $message = new Message;
        $message->message = $this->message;
        $message->sent = Carbon::now();
        $message->conversation_id = $conversation->id;
        $message->sender_email = $conversation->from_email;

        $message->save();

        Mail::to($conversation->from_email)->queue(new ContactMessageSentMail($message));
        Mail::to(config('mail.from.address'))->queue(new ContactMessageToAdminMail($message, $conversation));

        session()->flash('sent');
    }

    public function resetSession(): void
    {
        session()->forget('sent');
        $this->name = '';
        $this->email = '';
        $this->message = '';
    }
}
