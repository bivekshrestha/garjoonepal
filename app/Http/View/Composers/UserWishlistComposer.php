<?php

namespace App\Http\View\Composers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Modules\Category\Entities\Category;
use Modules\Product\Entities\Product;

class UserWishlistComposer
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
        $userWishlistItems = Product::select('id', 'title', 'price', 'slug')
            ->whereHas('wishlist', function($query) {
                $query->whereUserId(Auth::id());
            })
            ->get();

        $userWishlistCount = count($userWishlistItems);

        $view->with('userWishlistItems', $userWishlistItems)->with('userWishlistCount', $userWishlistCount);
    }
}
