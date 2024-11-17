<?php

namespace App\Livewire\Admin;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;
use Illuminate\View\View as ClassicView;
use Livewire\Attributes\Locked;
use Livewire\Component;

abstract class AbstractModelTable extends Component
{
    protected string $model = Model::class;

    protected int $perPage = 10;

    protected string $view;

    #[Locked]
    public string $sortBy = 'id';

    #[Locked]
    public string $sortDirection = 'asc';

    public function render(): Factory|View|Application|ClassicView
    {
        return view($this->view)->with(['data' => $this->query()->orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage)]);
    }

    protected function basicQuery(): Builder
    {
        return $this->model::query();
    }

    protected function query(): Builder
    {
        return $this->basicQuery();
    }
}
