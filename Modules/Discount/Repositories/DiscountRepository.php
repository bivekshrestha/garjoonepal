<?php

namespace Modules\Discount\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Discount\Entities\Discount;
use App\Repositories\BaseRepository;
use App\Traits\ImageUploadAble;
use Illuminate\Database\QueryException;
use InvalidArgumentException;

class DiscountRepository extends BaseRepository
{
    use ImageUploadAble;

    /**
     * TemplateRepository constructor.
     * @param Discount $model
     */
    public function __construct(Discount $model)
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
