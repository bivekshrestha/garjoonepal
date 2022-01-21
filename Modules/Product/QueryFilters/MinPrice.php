<?php

namespace Modules\Product\QueryFilters;

class MinPrice extends Filter
{
    /**
     * @param $builder
     * @return mixed
     */
    protected function applyFilter($builder)
    {
        return $builder->where('price', '>=', request($this->filterName()));
    }
}
