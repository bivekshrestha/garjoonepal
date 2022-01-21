<?php

namespace Modules\Classified\QueryFilters;

use Closure;
use Illuminate\Support\Str;

abstract class Filter
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!request()->has($this->filterName())) {
            return $next($request);
        }
        $builder = $next($request);

        return $this->applyFilter($builder);
    }

    /**
     * @return string
     */
    protected function filterName(): string
    {
        return Str::snake(class_basename($this));
    }

    /**
     * @param $builder
     * @return mixed
     */
    abstract protected function applyFilter($builder);
}
