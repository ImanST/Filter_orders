<?php

namespace App\ModelFilters;

use Illuminate\Database\Eloquent\Builder;

interface FilterModelInterface
{
    public function apply(Builder $query, $value);
}
