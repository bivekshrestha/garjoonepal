<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Category\Entities\Category;
use Modules\Category\Repositories\CategoryRepository;
use Modules\Location\Entities\Cities;
use Modules\Product\Repositories\ProductRepository;

class ProductController extends BaseController
{
    protected $itemRepository;
    protected $categoryRepository;

    /**
     * @param ProductRepository $itemRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(ProductRepository $itemRepository, CategoryRepository $categoryRepository)
    {
        $this->itemRepository = $itemRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data['products'] = $this->itemRepository->filterItem(request()->all(), false);
        return view('product::profile.index', $data);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function draft()
    {
        $data['products'] = $this->itemRepository->filterItem(request()->all(), true);
        return view('product::profile.draft', $data);
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $market = $this->categoryRepository->findItemByColumn('slug', 'market')->id;
        $data['categories'] = $this->categoryRepository->listItems(['id', 'name'], ['parent_id' => $market], [], 'name', 'asc');
        $data['cities'] = Cities::whereCountryId(147)->pluck('name');

        return view('product::profile.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $params = $request->except('_token');

        $this->itemRepository->createItem($params);

        return redirect()->route('my-product.index');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function saveAsDraft(Request $request)
    {
        $params = $request->except('_token');

        $this->itemRepository->draftItem($params);

        return redirect()->route('my-product.index');
    }

    /**
     * Show the specified resource.
     * @param $slug
     * @return Renderable
     */
    public function show($slug)
    {
        $data['product'] = $this->itemRepository->findItemByColumn('slug', $slug);
        $data['reviews'] = $data['product']->reviews;
        $data['cartId'] = $data['product']->cart()->whereUserId(Auth::id())->first() ? $data['product']->cart()->whereUserId(Auth::id())->first()->id : null;
        $data['wishlistId'] = $data['product']->wishlist()->whereUserId(Auth::id())->first() ? $data['product']->wishlist()->whereUserId(Auth::id())->first()->id : null;

        return view('product::show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Renderable
     */
    public function edit()
    {
        $data['categories'] = $this->itemRepository->listItems(['id', 'name']);
        $data['item'] = $this->itemRepository->findItemByColumn('id', request()->id);

        return view('product::profile.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $params = $request->except('_token');

        $this->itemRepository->updateItem($params);

        return redirect()->route('my-product.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return RedirectResponse
     */
    public function destroy()
    {
        $this->itemRepository->deleteItem(request()->id);

        toast('Product Deleted', 'success');

        return redirect()->route('my-product.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function searchAndFilter($slug = null)
    {
        $data['products'] = $this->itemRepository->searchAndFilterItem($slug);

        if($slug){
            $data['categories'] = Category::whereParentId(Category::whereSlug($slug)->pluck('id'))
                ->with('children')
                ->select('id', 'name')
                ->get();
        }else {
            $data['categories'] = Category::whereParentId(Category::whereSlug('market')->pluck('id'))
                ->with('children')
                ->select('id', 'name')
                ->get();
        }

        $data['locations'] = Cities::whereCountryId(147)->pluck('name');

        return view('product::filter.index', $data);
    }
}
