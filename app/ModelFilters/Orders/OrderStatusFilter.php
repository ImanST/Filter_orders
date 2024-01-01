<?php

namespace App\ModelFilters\Orders;

use App\ModelFilters\FilterModelInterface;
use Illuminate\Database\Eloquent\Builder;

class OrderStatusFilter implements FilterModelInterface
{
    public function apply(Builder $query, $value): Builder
    {
        return $query->where('status', $value);
    }
}
