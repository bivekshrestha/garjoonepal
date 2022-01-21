<?php

namespace App\View\Components;

use Illuminate\View\Component;

class OtherFilterInputs extends Component
{
    public $self;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($self)
    {
        $this->self = $self;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.other-filter-inputs');
    }
}
