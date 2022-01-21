<?php

namespace Modules\Classified\QueryFilters;

class Category extends Filter
{
    /**
     * @param $builder
     * @return mixed
     */
    protected function applyFilter($builder)
    {
        return $builder->whereIn('category_id', request($this->filterName()));
    }
}
