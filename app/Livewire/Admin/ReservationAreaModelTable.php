<?php

namespace App\Livewire\Admin;

use App\Models\ReservationArea;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Rule;

class ReservationAreaModelTable extends AbstractModelTable
{
    protected string $model = ReservationArea::class;

    protected string $view = 'livewire.admin.reservation-area-model-table';

    #[Rule('string', message: 'Klíč musí být řetězěc')]
    public string $key = '';

    #[Rule('string', message: 'Název musí být řetězěc')]
    public string $name = '';

    #[Rule('in:0,1,2', message: 'Aktivní obsahuje nesprávnou hodnotu')]
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
