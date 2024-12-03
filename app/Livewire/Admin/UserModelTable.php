<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Validate;

class UserModelTable extends AbstractModelTable
{
    protected string $model = User::class;

    protected string $view = 'livewire.admin.user-model-table';

    #[Validate('string', message: 'Jméno musí být text')]
    public string $first_name = '';

    #[Validate('string', message: 'Příjmení musí být text')]
    public string $last_name = '';

    #[Validate('string', message: 'E-mail musí být text')]
    public string $email = '';

    #[Validate('string', message: 'Telefon musí být text')]
    public string $phone = '';

    public string $role = 'unselected';

    public int $email_verified_at = 2;

    protected function query(): Builder
    {
        $query = $this->basicQuery();

        return $query
            ->where('id', '!=', user()->id)
            ->when(! empty($this->first_name), function (Builder $query) {
                $query->where('first_name', 'like', $this->first_name.'%');
            })
            ->when(! empty($this->last_name), function (Builder $query) {
                $query->where('last_name', 'like', $this->last_name.'%');
            })
            ->when(! empty($this->email), function (Builder $query) {
                $query->where('email', 'like', $this->email.'%');
            })
            ->when(! empty($this->phone), function (Builder $query) {
                $query->where('phone', 'like', $this->phone.'%');
            })
            ->when($this->role !== 'unselected', function (Builder $query) {
                $query->where('role', '=', $this->role);
            })
            ->when($this->email_verified_at != 2, function (Builder $query) {
                switch ($this->email_verified_at) {
                    case 1:
                        $query->whereNotNull('email_verified_at');
                        break;
                    default:
                        $query->whereNull('email_verified_at');
                        break;
                }
            });
    }

    public function resetFilters(): void
    {
        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->phone = '';
        $this->role = 'unselected';
        $this->email_verified_at = 2;
        $this->sortBy = 'id';
        $this->sortDirection = 'asc';
    }
}
