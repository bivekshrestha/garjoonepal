<?php

namespace Modules\Product\QueryFilters;

class MaxPrice extends Filter
{
    /**
     * @param $builder
     * @return mixed
     */
    protected function applyFilter($builder)
    {
        return $builder->where('price', '<=', request($this->filterName()));
    }
}
