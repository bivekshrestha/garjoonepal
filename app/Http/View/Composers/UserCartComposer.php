<?php

namespace App\Http\View\Composers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Modules\Category\Entities\Category;
use Modules\Product\Entities\Product;

class UserCartComposer
{

    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $userCartItems = Product::select('id', 'title', 'price', 'slug')
            ->whereHas('cart', function($query) {
                $query->whereUserId(Auth::id());
            })
            ->get();

        $userCartCount = count($userCartItems);

        $view->with('userCartItems', $userCartItems)->with('userCartCount', $userCartCount);
    }
}
