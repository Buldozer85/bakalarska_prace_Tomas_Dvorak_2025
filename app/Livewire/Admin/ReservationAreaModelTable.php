<?php

namespace App\Livewire\Admin;

use App\Models\ReservationArea;
use Illuminate\Database\Eloquent\Builder;

class ReservationAreaModelTable extends AbstractModelTable
{
    protected string $model = ReservationArea::class;

    protected string $view = 'livewire.admin.reservation-area-model-table';

    public string $key = '';

    public string $name = '';

    public int $is_active = 2;

    protected function query(): Builder
    {
        return $this->basicQuery()
            ->when(! empty($this->key), function (Builder $query) {
                $query->where('name', 'like', $this->key.'%');
            })
            ->when(! empty($this->name), function (Builder $query) {
                $query->where('name', 'like', $this->name.'%');
            })
            ->when($this->is_active != 2, function (Builder $query) {
                $query->where('is_active', $this->is_active);
            });
    }

    public function resetFilters(): void
    {
        $this->name = '';
        $this->is_active = 2;
        $this->key = '';
    }
}
