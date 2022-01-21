<?php

namespace Modules\Wishlist\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Modules\Cart\Repositories\CartRepository;
use Modules\Wishlist\Repositories\WishlistRepository;

class WishlistController extends Controller
{

    protected $itemRepository;
    protected $cartRepository;

    /**
     * WishlistController constructor.
     * @param WishlistRepository $itemRepository
     * @param CartRepository $cartRepository
     */
    public function __construct(WishlistRepository $itemRepository, CartRepository $cartRepository)
    {
        $this->itemRepository = $itemRepository;
        $this->cartRepository = $cartRepository;
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
            ['product:id,title,slug,price']
        );

        return view('wishlist::index', $data);
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

        toast('Item added to wishlist', 'success');

        return Redirect::back();
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function move(Request $request)
    {
        $this->itemRepository->moveItem($request->wishlist_id);

        toast('Item moved to cart.', 'success');

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request)
    {
        $this->itemRepository->deleteItem($request->wishlist_id);

        toast('Item removed from wishlist', 'success');

        return Redirect::back();
    }
}
