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
use Livewire\WithPagination;

abstract class AbstractModelTable extends Component
{
    use WithPagination;

    protected string $model = Model::class;

    public int $perPage = 10;

    protected string $view;

    #[Locked]
    public string $sortBy = 'id';

    #[Locked]
    public string $sortDirection = 'asc';

    #[Locked]
    public array $perPageOptions = [1 => 1, 10 => 10, 25 => 25, 50 => 50, 100 => 100, 200 => 200, 500 => 500, 1000 => 1000];

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

    public function delete(int $id): void
    {
        $model = $this->model::findOrFail($id);

        $model->delete();
    }

    public function setSortBy(string $sortBy): void
    {
        $this->sortBy = $sortBy;
        $this->sortDirection = match ($this->sortDirection) {
            'asc' => 'desc',
            'desc' => 'asc',
        };
    }

    abstract public function resetFilters(): void;
}
