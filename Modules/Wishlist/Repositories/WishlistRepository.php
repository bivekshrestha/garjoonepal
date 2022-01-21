<?php

namespace Modules\Wishlist\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Cart\Entities\Cart;
use Modules\Wishlist\Entities\Wishlist;
use App\Repositories\BaseRepository;
use App\Traits\ImageUploadAble;
use Illuminate\Database\QueryException;
use InvalidArgumentException;

class WishlistRepository extends BaseRepository
{
    use ImageUploadAble;

    /**
     * TemplateRepository constructor.
     * @param Wishlist $model
     */
    public function __construct(Wishlist $model)
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
            DB::beginTransaction();

            $collection = collect($params);

            $this->model->create($collection->all());

            DB::commit();

        } catch (QueryException $exception) {
            DB::rollBack();
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param $id
     */
    public function moveItem($id)
    {
        try {
            DB::beginTransaction();

            $wishlist = $this->findOneOrFail($id);

            $cart = Cart::whereUserId($wishlist->user_id)
                ->whereProductId($wishlist->product_id)
                ->first();

            if (!$cart) {
                Cart::create([
                    'user_id' => $wishlist->user_id,
                    'product_id' => $wishlist->product_id
                ]);
            }

            $wishlist->delete();

            DB::commit();

        } catch (QueryException $exception) {
            DB::rollBack();
            throw new InvalidArgumentException($exception->getMessage());
        }


    }

    /**
     * @param $id
     */
    public function deleteItem($id)
    {
        try {
            $item = $this->findOneOrFail($id);

            if ($item->image) {
                $this->deleteImage($item->image);
            }

            $item->delete();
        } catch (\Exception $e) {

        }

    }
}
