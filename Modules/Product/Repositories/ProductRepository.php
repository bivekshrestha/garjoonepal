<?php

namespace Modules\Product\Repositories;

use App\Models\Image;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Product\Entities\Product;
use App\Repositories\BaseRepository;
use App\Traits\ImageUploadAble;
use Illuminate\Database\QueryException;
use InvalidArgumentException;
use Modules\Product\QueryFilters\Category;
use Modules\Product\QueryFilters\City;
use Modules\Product\QueryFilters\Keyword;
use Modules\Product\QueryFilters\MaxPrice;
use Modules\Product\QueryFilters\MinPrice;
use Modules\Product\QueryFilters\SortBy;

class ProductRepository extends BaseRepository
{
    use ImageUploadAble;

    /**
     * TemplateRepository constructor.
     * @param Product $model
     */
    public function __construct(Product $model)
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

            $merge = $collection->except('images', 'rate', 'starts_on', 'ends_on');

            $merge['is_active'] = true;

            $item = $this->model->create($merge->all());

            if ($params['rate']) {
                $item->discount()->create([
                    'rate' => $params['rate'],
                    'starts_on' => $params['starts_on'],
                    'ends_on' => $params['ends_on']
                ]);
            }

            if (array_key_exists('images', $params)) {
                $images = $collection->only('images')->first();

                if (count($images) > 0) {
                    $path = $this->uploadImage($images[0], 'product/thumbnail', 200, 200);
                    $data = new Image(['path' => $path, 'type' => 'thumbnail']);
                    $item->images()->save($data);

                    foreach ($images as $key => $image) {
                        if ($image instanceof UploadedFile) {
                            $path = $this->uploadImage($image, 'product', 600, 600);
                            $data = new Image(['path' => $path, 'type' => 'image']);
                            $item->images()->save($data);
                        }
                    }
                }
            }


            DB::commit();

        } catch (QueryException $exception) {
            DB::rollBack();
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     */
    public function draftItem(array $params)
    {
        try {
            DB::beginTransaction();

            $collection = collect($params);

            $merge = $collection->except('images', 'rate', 'starts_on', 'ends_on');

            $merge['is_active'] = false;
            $merge['is_draft'] = false;

            $item = $this->model->create($merge->all());

            if ($params['rate']) {
                $item->discount()->create([
                    'rate' => $params['rate'],
                    'starts_on' => $params['starts_on'],
                    'ends_on' => $params['ends_on']
                ]);
            }

            if (array_key_exists('images', $params)) {
                $images = $collection->only('images')->first();

                if (count($images) > 0) {
                    $path = $this->uploadImage($images[0], 'product/thumbnail', 200, 200);
                    $data = new Image(['path' => $path, 'type' => 'thumbnail']);
                    $item->images()->save($data);

                    foreach ($images as $key => $image) {
                        if ($image instanceof UploadedFile) {
                            $path = $this->uploadImage($image, 'product', 600, 600);
                            $data = new Image(['path' => $path, 'type' => 'image']);
                            $item->images()->save($data);
                        }
                    }
                }
            }

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

            $merge = $collection->except('image');

            $item->update($merge->all());

            if (array_key_exists('image', $params) && $params['image'] instanceof UploadedFile) {
                if ($item->image) {
                    $this->deleteImage($item->image);
                }

                $path = $this->uploadImage($params['image'], 'category', 200, 200);
                $item->image = $path;
                $item->save();
            }
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
     * @param bool $draft
     * @return LengthAwarePaginator|Product
     */
    public function filterItem(array $params, bool $draft)
    {
        $collection = collect($params);

        $size = $collection->has('size') ? $collection['size'] : 10;

        $items = $this->model->query()->whereIsActive(!$draft)->whereIsDraft($draft);

        $items->where('user_id', Auth::id());

        if ($collection->has('keyword')) {
            $items->where('name', 'LIKE', '%' . $collection['keyword'] . '%');
        }

        if ($collection->has('sort_by')) {
            $items->orderBy($collection['sort_by'], $collection['sort_order']);
        }

        return $items->paginate($size);
    }

    /**
     * @return mixed
     */
    public function searchAndFilterItem($slug)
    {
        $products = $this->model->with('category')->whereIsActive(true);

        if ($slug) {
            $products->whereCategoryId(\Modules\Category\Entities\Category::where('slug', $slug)->pluck('id'));
        }

        return app(Pipeline::class)
            ->send($products)
            ->through([
                SortBy::class,
                Category::class,
                Keyword::class,
                City::class,
                MinPrice::class,
                MaxPrice::class,
            ])
            ->thenReturn()
            ->paginate(20);
    }
}
