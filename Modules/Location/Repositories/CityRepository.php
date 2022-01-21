<?php

namespace Modules\Location\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Location\Entities\Cities;
use App\Repositories\BaseRepository;
use App\Traits\ImageUploadAble;
use Illuminate\Database\QueryException;
use InvalidArgumentException;

class CityRepository extends BaseRepository
{
    use ImageUploadAble;

    /**
     * TemplateRepository constructor.
     * @param Cities $model
     */
    public function __construct(Cities $model)
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
        return $this->findOneOrFail($id);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateItem(array $params)
    {
        try {
            DB::beginTransaction();
            $item = $this->findOneOrFail($params['id']);

            $collection = collect($params);

            $item->update($collection->all());
            DB::commit();
            return $item;
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
        $item = $this->findOneOrFail($id);

        if ($item->image) {
            $this->deleteImage($item->image);
        }

        $item->delete();
    }

    /**
     * @param array $params
     * @return LengthAwarePaginator|Cities
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
