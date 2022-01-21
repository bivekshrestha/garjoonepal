<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Modules\Category\Entities\Category;

class CategoryTreeComposer
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
        $categories = Category::select('id', 'slug', 'name', 'parent_id', 'icon')
            ->whereParentId(null)
            ->get();

        $view->with('categoryTree', $categories);
    }
}
