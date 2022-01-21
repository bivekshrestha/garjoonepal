<?php

namespace Modules\Store\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Location\Entities\Country;
use Modules\Product\Entities\Product;
use Modules\Store\Entities\Store;
use Modules\Store\Http\Requests\StoreRequest;
use Modules\Store\Repositories\StoreRepository;

class StoreController extends BaseController
{

    protected $itemRepository;

    /**
     * @param StoreRepository $itemRepository
     */
    public function __construct(StoreRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Application|Factory|View|RedirectResponse
     */
    public function index()
    {
        $data['store'] = Auth::user()->store;

        if (!$data['store']) {
            return redirect()->route('my-store.create');
        }

        return view('store::profile.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $data['countries'] = Country::pluck('name', 'id');
        return view('store::profile.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $params = $request->except('_token');

        $this->itemRepository->createItem($params);

        return redirect()->route('my-store.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('store::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param $slug
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit($slug)
    {
        $data['store'] = Auth::user()->store;

        if (!$data['store']) {
            return redirect()->route('my-store.create');
        }

        $data['countries'] = Country::pluck('name', 'id');
        return view('store::profile.edit', $data);
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

        return redirect()->route('my-store.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function listing()
    {
        $data['stores'] = Store::with('limited_products')
            ->get();

        return view('store::list', $data);
    }

    public function view($slug)
    {
        $data['store'] = Store::where('slug', $slug)->first();

        return view('store::show', $data);
    }
}
