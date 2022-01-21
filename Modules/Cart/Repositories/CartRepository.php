<?php

namespace Modules\Cart\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Cart\Entities\Cart;
use App\Repositories\BaseRepository;
use App\Traits\ImageUploadAble;
use Illuminate\Database\QueryException;
use InvalidArgumentException;
use Modules\Wishlist\Entities\Wishlist;

class CartRepository extends BaseRepository
{
    use ImageUploadAble;

    /**
     * TemplateRepository constructor.
     * @param Cart $model
     */
    public function __construct(Cart $model)
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

            $wishlist = Wishlist::whereUserId($params['user_id'])
                ->whereProductId($params['product_id'])
                ->first();

            if ($wishlist) {
                $wishlist->delete();
            }

            $this->model->create($collection->all());

            DB::commit();

        } catch (QueryException $exception) {
            DB::rollBack();
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function editItem($id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * @param array $params
     */
    public function updateItem(array $params)
    {
        try {
            DB::beginTransaction();

            $item = $this->findOneOrFail($params['id']);

            $collection = collect($params);

            $item->update($collection->all());

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
