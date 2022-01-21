<?php

namespace Modules\Classified\QueryFilters;

class Keyword extends Filter
{
    /**
     * @param $builder
     * @return mixed
     */
    protected function applyFilter($builder)
    {
        $keywords = explode(' ', request($this->filterName()));

        foreach ($keywords as $keyword) {
            $builder->where('title', 'LIKE', '%' . $keyword . '%');
        }

        return $builder;
    }
}
