<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Location\Repositories\CityRepository;
use Modules\Location\Repositories\CountryRepository;

class CityController extends BaseController
{
    protected $itemRepository;
    protected $countryRepository;

    /**
     * @param CityRepository $itemRepository
     * @param CountryRepository $countryRepository
     */
    public function __construct(CityRepository $itemRepository, CountryRepository $countryRepository)
    {
        $this->itemRepository = $itemRepository;
        $this->countryRepository = $countryRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data['countries'] = $this->itemRepository->filterItems(request()->all());
        return view('admin::pages.city.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $data['countries'] = $this->countryRepository->listItems(['id', 'name']);
        return view('admin::pages.city.create', $data);
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

        return redirect()->route('admin.city.index');
    }

    /**
     * Show the specified resource.
     * @return Renderable
     */
    public function show()
    {
        $data['country'] = $this->itemRepository->findItemByColumn('id', request()->id);

        return view('admin::pages.city.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Renderable
     */
    public function edit()
    {
        $data['countries'] = $this->countryRepository->listItems(['id', 'name']);
        $data['item'] = $this->itemRepository->findItemByColumn('id', request()->id);

        return view('admin::pages.city.edit', $data);
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

        return redirect()->route('admin.city.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return RedirectResponse
     */
    public function destroy()
    {
        $this->itemRepository->deleteItem(request()->id);

        toast('Country Deleted', 'success');

        return redirect()->route('admin.city.index');
    }
}
