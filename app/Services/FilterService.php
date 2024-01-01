<?php

namespace App\Services;

use App\ModelFilters\Orders\OrderCustomerNationalCodeFilter;
use App\ModelFilters\Orders\OrderAmountFilter;
use App\ModelFilters\Orders\OrderStatusFilter;
use Exception;
use Illuminate\Database\Eloquent\Builder;

class FilterService
{
    protected array $filters = [
        'status' => OrderStatusFilter::class,
        'nationalCode' => OrderCustomerNationalCodeFilter::class,
        'amount' => OrderAmountFilter::class,
        // Add more filters as needed
    ];

    /**
     * @throws Exception
     */
    public function applyFilters(Builder $query, array $filters): Builder
    {
        foreach ($filters as $filterName => $filterValue) {

            $filter = $this->getFilterInstance($filterName);

            if ($filter) {
                $query = $filter->apply($query, $filterValue);
            }
        }
        return $query;
    }

    /**
     * @throws Exception
     */
    protected function getFilterInstance(string $filterName)
    {
        if (array_key_exists($filterName, $this->filters)) {
            $filterClass = $this->filters[$filterName];
            return new $filterClass();
        }

        // Throw an exception when the filter is not found
        throw new Exception("Filter class not found for $filterName");
    }
}
