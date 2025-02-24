<?php

namespace App\Livewire\Admin;

use App\Models\WebsiteSetting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Validate;

class WebsiteSettingModelTable extends AbstractModelTable
{
    protected string $view = 'livewire.admin.website-setting-model-table';

    protected string $model = WebsiteSetting::class;

    #[Validate('string', message: 'Klíč musí být text')]
    public string $key = '';

    #[Validate('string', message: 'Hodnota musí být text')]
    public string $value = '';

    protected function query(): Builder
    {
        return $this->basicQuery()
            ->when(! empty($this->key), function (Builder $builder) {
                $builder->where('key', 'like', $this->key.'%');
            })
            ->when(! empty($this->value), function (Builder $builder) {
                $builder->where('value', 'like', $this->value.'%');
            });
    }

    public function resetFilters(): void
    {
        $this->key = '';
        $this->value = '';
        $this->sortBy = 'id';
        $this->sortDirection = 'asc';
    }

    public function eraseCache(): void
    {
        Cache::flush();
        flash('Cache aplikace byla promazána');
    }
}
