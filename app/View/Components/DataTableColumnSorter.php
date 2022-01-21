<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DataTableColumnSorter extends Component
{
    public $column;
    public $route;

    /**
     * Create a new component instance.
     *
     * @param $column
     * @param $route
     */
    public function __construct($column, $route)
    {
        $this->column = $column;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|\Closure|string
     */
    public function render()
    {
        return view('components.data-table-column-sorter');
    }
}
