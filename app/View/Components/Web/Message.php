<?php

namespace App\View\Components\Web;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Message extends Component
{
    public function __construct(
        public \App\Models\Message $message
    ) {}

    public function render(): View
    {
        return view('components.web.message');
    }
}
