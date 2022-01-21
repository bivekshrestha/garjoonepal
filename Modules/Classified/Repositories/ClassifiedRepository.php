<?php

namespace Modules\Classified\Repositories;

use App\Helpers\Helper;
use App\Models\Image;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Attribute\Entities\Attribute;
use Modules\Classified\Entities\Classified;
use App\Repositories\BaseRepository;
use App\Traits\ImageUploadAble;
use Illuminate\Database\QueryException;
use InvalidArgumentException;
use Modules\Classified\Entities\ClassifiedAttribute;
use Modules\Classified\QueryFilters\Category;
use Modules\Classified\QueryFilters\Keyword;
use Modules\Classified\QueryFilters\MaxPrice;
use Modules\Classified\QueryFilters\MinPrice;
use Modules\Classified\QueryFilters\SortBy;

class ClassifiedRepository extends BaseRepository
{
    use ImageUploadAble;

    /**
     * TemplateRepository constructor.
     * @param Classified $model
     */
    public function __construct(Classified $model)
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
    public function listItems(array $columns = ['*'], array $conditions = [], array $relations = [], string $order = 'id', string $sort = 'asc')
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

            $collection = collect(Helper::getExcept($params, 'attribute_'));

            $attributes = Helper::getOnly($params, 'attribute_');

            $merge = $collection->except('images');

            $merge['is_active'] = true;

            $item = $this->model->create($merge->all());

            if (array_key_exists('images', $params)) {
                $images = $collection->only('images')->first();

                if (count($images) > 0) {
                    $path = $this->uploadImage($images[0], 'classified/thumbnail', 200, 200);
                    $data = new Image(['path' => $path, 'type' => 'thumbnail']);
                    $item->images()->save($data);

                    foreach ($images as $key => $image) {
                        if ($image instanceof UploadedFile) {
                            $path = $this->uploadImage($image, 'classified', 600, 600);
                            $data = new Image(['path' => $path, 'type' => 'image']);
                            $item->images()->save($data);
                        }
                    }
                }
            }

            foreach ($attributes as $key => $value) {
                $attribute = new ClassifiedAttribute([
                    'name' => Str::after($key, 'attribute_'),
                    'value' => $value
                ]);
                $item->attributes()->save($attribute);
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

            $merge = $collection->except('images');

            $merge['is_active'] = false;
            $merge['is_draft'] = false;

            $item = $this->model->create($merge->all());

            if (array_key_exists('images', $params)) {
                $images = $collection->only('images')->first();

                if (count($images) > 0) {
                    $path = $this->uploadImage($images[0], 'classified/thumbnail', 200, 200);
                    $data = new Image(['path' => $path, 'type' => 'thumbnail']);
                    $item->images()->save($data);

                    foreach ($images as $key => $image) {
                        if ($image instanceof UploadedFile) {
                            $path = $this->uploadImage($image, 'classified', 600, 600);
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
     * @return LengthAwarePaginator|Classified
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
     * @param $type
     * @param $slug
     * @return mixed
     */
    public function searchAndFilterItem($type, $slug)
    {
        $items = $this->model
            ->with('category')
            ->with('attributes')
            ->whereType($type)
            ->whereIsActive(true);

        if ($slug) {
            $items->whereCategoryId(\Modules\Category\Entities\Category::where('slug', $slug)->pluck('id'));
        }

        foreach (request()->all() as $key => $value) {
            if(is_array($value)){
                $items->whereHas('attributes', function ($query) use ($key, $value) {
                    $query->where('name', $key)
                        ->whereIn('value', $value);
                });
            }
        }

        return app(Pipeline::class)
            ->send($items)
            ->through([
                SortBy::class,
                Category::class,
                Keyword::class,
                MinPrice::class,
                MaxPrice::class,
            ])
            ->thenReturn()
            ->paginate(20);
    }

    /**
     * @param $type
     * @return mixed
     */
    public function getFilterAttributes($type)
    {
        $attributes = Attribute::select('name', 'options')
            ->whereCategory($type)
            ->whereIsFilterable(true)
            ->get();

        foreach ($attributes as $attribute) {
            $attribute->display_name = $attribute->name;

            $attribute->name = Str::of($attribute->name)->lower()->snake()->__toString();

            if (!$attribute->options) {
                $items = ClassifiedAttribute::where('name', $attribute->name)
                    ->with('classified')->whereHas('classified', function ($query) use ($type) {
                        $query->where('type', $type);
                    })->select('name', 'value', 'classified_id')
                    ->get()
                    ->unique('value');

                $options = [];

                foreach ($items as $item) {
                    array_push($options, $item->value);
                }

                $attribute->options = $options;
            }
        }

        return $attributes;
    }
}
