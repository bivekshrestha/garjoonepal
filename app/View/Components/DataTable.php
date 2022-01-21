<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DataTable extends Component
{
    public $route;
    public $items;
    public $columns;
    public $sort;

    /**
     * Create a new component instance.
     *
     * @param $route
     * @param $items
     * @param array $columns
     * @param array $sort
     */
    public function __construct($route, $items, array $columns, array $sort)
    {
        $this->route = $route;
        $this->items = $items;
        $this->columns = $columns;
        $this->sort = $sort;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.data-table');
    }
}
