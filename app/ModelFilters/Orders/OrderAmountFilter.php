<?php

namespace App\ModelFilters\Orders;

use App\ModelFilters\FilterModelInterface;
use Exception;
use Illuminate\Database\Eloquent\Builder;

class OrderAmountFilter implements FilterModelInterface
{
    /**
     * @throws Exception
     */
    public function apply(Builder $query, $value) {
        if (!isset($value['min']) && !isset($value['max'])) {
            throw new Exception("Amount parameter should at least has min or max value");
        } else {
            if (isset($value['min'])) {
                $query = $query->where('amount', '>=', $value['min']);
            }

            if (isset($value['max'])) {
                $query = $query->where('amount', '<=', $value['max']);
            }
        }

        return $query;
    }
}
