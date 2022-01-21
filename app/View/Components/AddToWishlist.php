<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddToWishlist extends Component
{
    public $productId;
    public $wishlistId;

    /**
     * Create a new component instance.
     *
     * @param int $productId
     * @param $wishlistId
     */
    public function __construct(int $productId, $wishlistId)
    {
        $this->productId = $productId;
        $this->wishlistId = $wishlistId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|\Closure|string
     */
    public function render()
    {
        return view('components.add-to-wishlist');
    }
}
