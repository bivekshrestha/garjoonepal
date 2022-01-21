<?php

namespace Modules\Cart\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Modules\Cart\Repositories\CartRepository;

class CartController extends Controller
{

    protected $itemRepository;

    /**
     * CartController constructor.
     * @param CartRepository $itemRepository
     */
    public function __construct(CartRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data['items'] = $this->itemRepository->listItems(
            ['id', 'user_id', 'product_id'],
            ['user_id' => Auth::id()],
            ['product:id,title,slug,price,category_id']
        );

        return view('cart::index', $data);
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

        toast('Item added to cart', 'success');

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request)
    {
        $this->itemRepository->deleteItem($request->cart_id);

        toast('Item removed from cart', 'success');

        return Redirect::back();
    }
}
