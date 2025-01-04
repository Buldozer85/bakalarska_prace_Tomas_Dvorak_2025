<?php

namespace App\Livewire\Admin;

use App\Models\Conversation;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Conversations extends Component
{
    use WithPagination;

    public function query(): \Illuminate\Database\Eloquent\Builder|\LaravelIdea\Helper\App\Models\_IH_Conversation_QB
    {
        return Conversation::query()->with('messages')->whereHas('messages', function (Builder $query) {
            return $query->orderBy('viewed')->orderBy('sent', 'desc');
        });
    }

    public function render()
    {
        return view('livewire.admin.conversations')->with(['conversations' => $this->query()->paginate(25)]);
    }
}
