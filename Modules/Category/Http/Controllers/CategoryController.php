<?php

namespace Modules\Category\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\Category\Repositories\CategoryRepository;
use Modules\Category\Transformers\CategoryCollection;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('category::site.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('category::site.index');
    }

    public function treeView()
    {
        $category = $this->categoryRepository->listItems(
            ['id', 'name', 'slug'],
            ['parent_id' => null],
            ['descendants']
        );

        if (Helper::wantsJsonResponse()) {
            return new CategoryCollection($category);
        }
    }
}
