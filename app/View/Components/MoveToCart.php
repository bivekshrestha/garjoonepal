<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MoveToCart extends Component
{
    public $wishlistId;

    /**
     * Create a new component instance.
     *
     * @param $wishlistId
     */
    public function __construct($wishlistId)
    {
        $this->wishlistId = $wishlistId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|\Closure|string
     */
    public function render()
    {
        return view('components.move-to-cart');
    }
}
