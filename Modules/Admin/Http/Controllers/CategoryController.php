<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Category\Repositories\CategoryRepository;

class CategoryController extends BaseController
{
    protected $itemRepository;

    /**
     * @param CategoryRepository $itemRepository
     */
    public function __construct(CategoryRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data['categories'] = $this->itemRepository->filterItems(request()->all());
        return view('admin::pages.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $data['categories'] = $this->itemRepository->listItems(['id', 'name']);
        return view('admin::pages.category.create', $data);
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

        toast('Category Added', 'success');

        return redirect()->route('admin.category.index');
    }

    /**
     * Show the specified resource.
     * @return Renderable
     */
    public function show()
    {
        $data['category'] = $this->itemRepository->findItemByColumn('id', request()->id);

        return view('admin::pages.category.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Renderable
     */
    public function edit()
    {
        $data['categories'] = $this->itemRepository->listItems(['id', 'name']);
        $data['item'] = $this->itemRepository->findItemByColumn('id', request()->id);

        return view('admin::pages.category.edit', $data);
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

        toast('Category Updated', 'success');

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return RedirectResponse
     */
    public function destroy()
    {
        $this->itemRepository->deleteItem(request()->id);

        toast('Category Deleted', 'success');

        return redirect()->route('admin.category.index');
    }
}
