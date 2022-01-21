<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class BaseRepository
 *
 * @package \App\Repositories
 */
class BaseRepository
{
    protected $model;

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param string[] $columns
     * @param array $conditions
     * @param array $relations
     * @param string $orderBy
     * @param string $sortBy
     * @return mixed
     */
    public function getItems($columns = array('*'), $conditions = array(), $relations = array(), $orderBy = 'created_at', $sortBy = 'asc')
    {
        $data = $this->model->with($relations);

        if (count($conditions) > 0) {
            foreach ($conditions as $column => $value) {
                $data->where($column, $value);
            }
        }

        return $data->orderBy($orderBy, $sortBy)->get($columns);
    }

    /**
     * @param $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findOneOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param $column
     * @param $value
     * @return Model
     */
    public function findItemByColumn($column, $value)
    {
        return $this->model->where($column, $value)->first();
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @param array $attributes
     * @param $id
     * @return bool
     */
    public function update(array $attributes, $id): bool
    {
        return $this->findOneOrFail($id)->update($attributes);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->findOneOrFail($id)->delete();
    }
}
