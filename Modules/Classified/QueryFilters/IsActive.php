<?php

namespace Modules\Classified\QueryFilters;

class IsActive extends Filter
{
    /**
     * @param $builder
     * @return mixed
     */
    protected function applyFilter($builder)
    {
        return $builder->where($this->filterName(), request($this->filterName()));
    }
}
