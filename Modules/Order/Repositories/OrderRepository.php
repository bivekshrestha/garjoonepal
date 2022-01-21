<?php

namespace Modules\Order\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Cart\Entities\Cart;
use Modules\Order\Entities\Order;
use App\Repositories\BaseRepository;
use Illuminate\Database\QueryException;
use InvalidArgumentException;

class OrderRepository extends BaseRepository
{

    /**
     * TemplateRepository constructor.
     * @param Order $model
     */
    public function __construct(Order $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param array|string[] $columns
     * @param array $conditions
     * @param array $relations
     * @param string $order
     * @param string $sort
     * @return mixed
     */
    public function listItems(array $columns = ['*'], array $conditions = [], array $relations = [], $order = 'id', $sort = 'asc')
    {
        return $this->getItems($columns, $conditions, $relations, $order, $sort);
    }

    /**
     * @param $column
     * @param $value
     * @return Model
     */
    public function findItemByColumn($column, $value)
    {
        return parent::findItemByColumn($column, $value);
    }

    /**
     * @param array $params
     */
    public function createItem(array $params)
    {
        try {

            $collection = collect($params);

            DB::beginTransaction();
            $carts = Auth::user()->carts;

            $order = new Order();
            $order->reference_number = 'OD-REF-' . time() . Auth::id();
            $order->user_id = Auth::id();
            $order->receiver_name = $collection['receiver_name'];
            $order->receiver_number = $collection['receiver_number'];
            $order->receiver_email = $collection['receiver_email'];
            $order->shipping_address = $collection['shipping_address'];
            $order->sub_total = 0;
            $order->discount = 0;
            $order->grand_total = 0;
            $order->shipping_charge = $collection['shipping_area'] == 'inside' ? 0 : 10;

            $order->save();

            foreach ($carts as $cart) {
                $discount = 0;

                if ($cart->product->discount) {
                    $discount += $cart->product->price - (($cart->product->discount->rate / 100) * $cart->product->price);
                }

                $order->discount += $discount;

                $item = $order->items()->create([
                    'product_id' => $cart->product->id,
                    'original_price' => $cart->product->price,
                    'discount_rate' => $cart->product->discount ? $cart->product->discount->rate : 0,
                    'purchase_price' => $cart->product->price - $discount,
                ]);

                $order->sub_total += $item->original_price;
            }

            $order->grand_total = $order->sub_total - $order->discount + $order->shipping_charge;

            $order->save();

            Cart::destroy($carts->pluck('id'));

            DB::commit();

            toast('Your order has been placed successfully.');
            return redirect()->route('home');

        } catch (QueryException $exception) {
            DB::rollBack();
            throw new \InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param $id
     */
    public function deleteItem($id)
    {
        $item = $this->findOneOrFail($id);

        if ($item->image) {
            $this->deleteImage($item->image);
        }

        $item->delete();
    }

    /**
     * @param array $params
     * @return LengthAwarePaginator|Order
     */
    public function filterItems(array $params)
    {
        $collection = collect($params);

        $size = $collection->has('size') ? $collection['size'] : 10;

        $items = $this->model->query();

        if ($collection->has('keyword')) {
            $items->where('name', 'LIKE', '%' . $collection['keyword'] . '%');
        }

        if ($collection->has('sort_by')) {
            $items->orderBy($collection['sort_by'], $collection['sort_order']);
        }

        return $items->paginate($size);
    }
}
