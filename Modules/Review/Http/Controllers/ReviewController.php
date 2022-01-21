<?php

namespace Modules\Review\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Review\Repositories\ReviewRepository;

class ReviewController extends Controller
{
    protected $reviewRepository;

    /**
     * ReviewController constructor.
     * @param ReviewRepository $reviewRepository
     */
    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $params = $request->except('_token');

        $this->reviewRepository->createItem($params);

        toast('Review posted', 'success');
        return Redirect::back();
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $params = $request->except('_token');

        $this->reviewRepository->updateItem($params);

        toast('Review updated', 'success');
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     * @return RedirectResponse
     */
    public function destroy(Request $request)
    {
        $id = $request->id;

        $this->reviewRepository->deleteItem($id);

        toast('Review deleted', 'success');
        return Redirect::back();
    }
}
