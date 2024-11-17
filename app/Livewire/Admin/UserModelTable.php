<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserModelTable extends AbstractModelTable
{
    protected string $model = User::class;

    protected string $view = 'livewire.admin.user-model-table';

    public string $first_name = '';

    public string $last_name = '';

    public string $email = '';

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

    public function setSortBy(string $sortBy): void
    {

        $this->sortBy = $sortBy;
        $this->sortDirection = match ($this->sortDirection) {
            'asc' => 'desc',
            'desc' => 'asc',
        };
    }
}
