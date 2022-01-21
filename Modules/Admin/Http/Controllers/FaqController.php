<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Faq\Repositories\FaqRepository;

class FaqController extends Controller
{
    protected $faqRepository;

    /**
     * FaqController constructor.
     * @param FaqRepository $faqRepository
     */
    public function __construct(FaqRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data['faqs'] = $this->faqRepository->filterItems(request()->all());
        return view('admin::pages.faq.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::pages.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $params = $request->except('_token');
        $this->faqRepository->createItem($params);

        toast('FAQ Added', 'success');

        return redirect()->route('admin.faq.index');
    }

    /**
     * Show the specified resource.
     * @return Renderable
     */
    public function show()
    {
        $data['faq'] = $this->faqRepository->findItemByColumn('id', request()->id);

        return view('admin::pages.faq.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Renderable
     */
    public function edit()
    {
        $data['faq'] = $this->faqRepository->findItemByColumn('id', request()->id);

        return view('admin::pages.faq.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $params = $request->except('_token');
        $this->faqRepository->updateItem($params);

        toast('FAQ Updated', 'success');

        return redirect()->route('admin.faq.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return RedirectResponse
     */
    public function destroy()
    {
        $this->faqRepository->deleteItem(request()->id);

        toast('FAQ Deleted', 'success');

        return redirect()->route('admin.faq.index');
    }
}
