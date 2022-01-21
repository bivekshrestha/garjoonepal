<?php

namespace Modules\Product\QueryFilters;

class SortBy extends Filter
{
    /**
     * @param $builder
     * @return mixed
     */
    protected function applyFilter($builder)
    {
        switch (request($this->filterName())) {
            case 'oldest':
                return $builder->orderBy('created_at', 'asc');
            case 'latest':
                return $builder->orderBy('created_at', 'desc');
            case 'low_high':
                return $builder->orderBy('price', 'asc');
            case 'high_low':
                return $builder->orderBy('price', 'desc');
            default:
                return $builder->orderBy('name', 'asc');
        }
    }
}
