<?php

namespace Modules\Product\QueryFilters;

class City extends Filter
{
    /**
     * @param $builder
     * @return mixed
     */
    protected function applyFilter($builder)
    {
        return $builder->whereIn('city', request($this->filterName()));
    }
}
