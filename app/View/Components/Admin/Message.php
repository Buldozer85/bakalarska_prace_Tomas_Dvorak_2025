<?php

namespace App\View\Components\Admin;

use App\Models\Message as MessageModel;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Message extends Component
{
    public function __construct(
        public MessageModel $message,
        public bool $isAdmin = false
    ) {}

    public function render(): View
    {
        return view('components.admin.message');
    }
}
