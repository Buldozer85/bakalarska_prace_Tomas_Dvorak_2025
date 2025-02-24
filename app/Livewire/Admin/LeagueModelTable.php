<?php

namespace App\Livewire\Admin;

use App\Models\League;
use Illuminate\Database\Eloquent\Builder;

class LeagueModelTable extends AbstractModelTable
{
    public string $name = '';

    public string $year = '';

    public string $start = '';

    public string $end = '';

    protected string $model = League::class;

    protected string $view = 'livewire.admin.league-model-table';

    protected function query(): Builder
    {
        return $this->basicQuery()
            ->when(! empty($this->name), function (Builder $builder) {
                $builder->where('name', 'like', $this->name.'%');
            })
            ->when(! empty($this->year), function (Builder $builder) {
                $builder->where('year', '=', $this->year);
            })
            ->when(! empty($this->start), function (Builder $builder) {
                $builder->where('start', '>=', $this->start);
            })
            ->when(! empty($this->end), function (Builder $builder) {
                $builder->where('end', '<=', $this->end);
            });
    }

    public function resetFilters(): void
    {
        $this->reset('name', 'year', 'start', 'end');
    }
}
