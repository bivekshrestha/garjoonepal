<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddToCart extends Component
{

    public $productId;
    public $cartId;

    /**
     * Create a new component instance.
     *
     * @param int $productId
     * @param $cartId
     */
    public function __construct(int $productId, $cartId)
    {
        $this->productId = $productId;
        $this->cartId = $cartId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|\Closure|string
     */
    public function render()
    {
        return view('components.add-to-cart');
    }
}
