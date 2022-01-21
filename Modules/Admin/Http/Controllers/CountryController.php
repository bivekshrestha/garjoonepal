<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Location\Repositories\CountryRepository;

class CountryController extends BaseController
{
    protected $itemRepository;

    /**
     * @param $itemRepository
     */
    public function __construct(CountryRepository $itemRepository)
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
        return view('admin::pages.country.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::pages.country.create');
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

        return redirect()->route('admin.country.index');
    }

    /**
     * Show the specified resource.
     * @return Renderable
     */
    public function show()
    {
        $data['country'] = $this->itemRepository->findItemByColumn('id', request()->id);

        return view('admin::pages.country.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Renderable
     */
    public function edit()
    {
        $data['item'] = $this->itemRepository->findItemByColumn('id', request()->id);

        return view('admin::pages.country.edit', $data);
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

        return redirect()->route('admin.country.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return RedirectResponse
     */
    public function destroy()
    {
        $this->itemRepository->deleteItem(request()->id);

        toast('Country Deleted', 'success');

        return redirect()->route('admin.country.index');
    }
}
