<?php

namespace App\Livewire\Admin;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Validate;

class ReservationModelTable extends AbstractModelTable
{
    protected string $view = 'livewire.admin.reservation-model-table';

    protected string $model = Reservation::class;

    public string $date = '';

    #[Validate('numeric', message: 'Od musí být číslo')]
    public ?int $slot_from = null;

    #[Validate('numeric', message: 'Do musí být číslo')]
    public ?int $slot_to = null;

    public string $type = '';

    #[Validate('string', message: 'Rezervovatel musí být řetězec')]
    public string $reservation_name = '';

    #[Validate('string', message: 'Telefon musí být řetězec')]
    public string $phone = '';

    #[Validate('in:unselected,waiting,confirmed,cancelled', message: 'Status obsahuje neznámou hodnotu')]
    public string $status = 'unselected';

    #[Validate('in:0,1,2', message: 'Na firmu obsahuje neznámou hodnotu')]
    public int $on_company = 2;

    public string $user = '';

    protected function query(): Builder
    {
        return $this->basicQuery()
            ->when(! empty($this->date), function (Builder $query) {
                $query->whereDate('date', '=', $this->date);
            })
            ->when(! is_null($this->slot_from), function (Builder $query) {
                return $query->where('slot_from', '>=', $this->slot_from);
            })
            ->when(! is_null($this->slot_to) && $this->slot_to >= $this->slot_from, function (Builder $query) {
                return $query->where('slot_to', '<=', $this->slot_to);
            })
            ->when(! empty($this->type), function (Builder $query) {
                return $query->where('type', '=', $this->type);
            })
            ->when(! empty($this->reservation_name), function (Builder $query) {
                $exploded = explode(' ', $this->reservation_name);

                $query->join('users', 'user_id', '=', 'users.id')
                    ->where('users.first_name', 'like', $exploded[0].'%');

                if (count($exploded) > 1) {
                    $query->where('users.last_name', 'like', $exploded[1].'%');
                }

                return $query;
            })
            ->when(! empty($this->phone), function (Builder $query) {
                return $query->where('phone', 'like', $this->phone.'%');
            })
            ->when($this->status !== 'unselected', function (Builder $query) {
                return match ($this->status) {
                    'waiting' => $query->whereNull('confirmed')->whereNull('cancelled'),
                    'confirmed' => $query->whereNotNull('confirmed'),
                    'cancelled' => $query->whereNotNull('cancelled'),
                    default => $query,
                };
            })
            ->when($this->on_company !== 2, function (Builder $query) {
                return $query->where('on_company', '=', $this->on_company);
            })
            ->when(! empty($this->user), function (Builder $query) {
                return $query->whereHas('user', function (Builder $query) {
                    $query->where('email', 'like', $this->user.'%');
                });
            });
    }

    public function resetFilters(): void
    {
        $this->slot_from = null;
        $this->slot_to = null;
        $this->type = '';
        $this->reservation_name = '';
        $this->phone = '';
        $this->status = 'unselected';
        $this->on_company = 2;
    }
}
