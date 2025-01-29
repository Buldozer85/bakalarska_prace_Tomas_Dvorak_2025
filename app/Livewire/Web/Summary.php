<?php

namespace App\Livewire\Web;

use Carbon\Carbon;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Summary extends Component
{
    #[Reactive]
    public ?Carbon $date;

    #[Reactive]
    public ?Carbon $from;

    #[Reactive]
    public ?Carbon $to;

    #[Reactive]
    public ?Carbon $expiry;

    #[Reactive]
    public int $currentStep;

    public function render()
    {
        return view('livewire.web.summary');
    }
}
