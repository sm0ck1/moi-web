<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class DomainScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        if (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] != 'moi-web.test') {
            $builder->whereHas('domain', function (Builder $query) {
                $query->where('name', $_SERVER['HTTP_HOST']);
            })->orderBy('created_at', 'desc');
        }
    }
}
