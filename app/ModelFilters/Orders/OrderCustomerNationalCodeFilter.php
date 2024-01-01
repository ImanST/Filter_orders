<?php

namespace App\ModelFilters\Orders;

use App\ModelFilters\FilterModelInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

class OrderCustomerNationalCodeFilter implements FilterModelInterface
{
    public function apply(Builder $query, $value): Builder
    {
        return $query
            ->select('orders.*')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->where('national_code', $value);
    }
}
