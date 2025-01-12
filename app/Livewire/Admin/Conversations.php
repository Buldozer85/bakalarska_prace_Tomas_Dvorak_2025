<?php

namespace App\Livewire\Admin;

use App\Models\Conversation;
use App\Models\Message;
use Livewire\Component;
use Livewire\WithPagination;

class Conversations extends Component
{
    use WithPagination;

    public function query()
    {
        return Conversation::query()
            ->with('messages') // Načtení relace messages (pro případné další použití)
            ->whereHas('messages') // Zajištění, že konverzace má alespoň jednu zprávu
            ->addSelect(['last_sent' => Message::select('sent') // Přidání sloupce `sent` pro řazení
                ->whereColumn('messages.conversation_id', 'conversations.id') // Propojení tabulek
                ->orderBy('sent', 'desc') // Nejnovější hodnota `sent`
                ->limit(1), // Pouze jedna hodnota
            ])
            ->orderBy('last_sent', 'desc'); // Řazení podle posledního `sent`

    }

    public function render()
    {
        return view('livewire.admin.conversations')->with(['conversations' => $this->query()->paginate(25)]);
    }
}
