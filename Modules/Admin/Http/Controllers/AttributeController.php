<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Attribute\Repositories\AttributeRepository;

class AttributeController extends BaseController
{
    protected $attributeRepository;

    /**
     * @param AttributeRepository $attributeRepository
     */
    public function __construct(AttributeRepository $attributeRepository)
    {
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data['attributes'] = $this->attributeRepository->filterItems(request()->all());
        return view('admin::pages.attribute.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::pages.attribute.create');
    }

    /**
     * Show the form for creating a new resource.
     * @return string
     */
    public function add()
    {
        $id = request()->id;
        return view('admin::pages.attribute.add', compact('id'))->render();
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $params = $request->except('_token');

        $this->attributeRepository->createItem($params);

        toast('Attribute Added', 'success');

        return redirect()->route('admin.attribute.index');
    }

    /**
     * Show the specified resource.
     * @return Renderable
     */
    public function show()
    {
        $data['attribute'] = $this->attributeRepository->findItemByColumn('id', request()->id);

        return view('admin::pages.attribute.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Renderable
     */
    public function edit()
    {
        $data['attribute'] = $this->attributeRepository->findItemByColumn('id', request()->id);

        return view('admin::pages.attribute.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $params = $request->except('_token');

        $this->attributeRepository->updateItem($params);

        toast('Attribute Updated', 'success');

        return redirect()->route('admin.attribute.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return RedirectResponse
     */
    public function destroy()
    {
        $this->attributeRepository->deleteItem(request()->id);

        toast('Attribute Deleted', 'success');

        return redirect()->route('admin.attribute.index');
    }
}
