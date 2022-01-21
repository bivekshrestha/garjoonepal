<?php

namespace Modules\Classified\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Controllers\BaseController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Modules\Attribute\Entities\Attribute;
use Modules\Attribute\Repositories\AttributeRepository;
use Modules\Category\Entities\Category;
use Modules\Category\Repositories\CategoryRepository;
use Modules\Classified\Entities\Classified;
use Modules\Classified\Entities\ClassifiedAttribute;
use Modules\Location\Entities\Cities;
use Modules\Classified\Repositories\ClassifiedRepository;

class ClassifiedController extends BaseController
{
    protected $classifiedRepository;
    protected $categoryRepository;
    protected $attributeRepository;

    /**
     * @param ClassifiedRepository $classifiedRepository
     * @param CategoryRepository $categoryRepository
     * @param AttributeRepository $attributeRepository
     */
    public function __construct(ClassifiedRepository $classifiedRepository, CategoryRepository $categoryRepository, AttributeRepository $attributeRepository)
    {
        $this->classifiedRepository = $classifiedRepository;
        $this->categoryRepository = $categoryRepository;
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data['ads'] = $this->classifiedRepository->filterItem(request()->all(), false);
        return view('classified::profile.index', $data);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function draft()
    {
        $data['classifieds'] = $this->classifiedRepository->filterItem(request()->all(), true);
        return view('classified::profile.draft', $data);
    }


    public function addNew()
    {
        return view('classified::profile.add');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        $category = $this->categoryRepository->findItemByColumn('slug', $request->type);
        $data['categories'] = $this->categoryRepository->listItems(['id', 'name'], ['parent_id' => $category->id], [], 'name');
        $data['mainCategory'] = $category->name;
        unset($category);

        $data['type'] = $request->type;

        $data['attributes'] = $this->attributeRepository->listItems(['name', 'slug', 'options', 'type', 'category'], ['category' => $request->type], [], 'name');

        return view('classified::profile.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $params = $request->except('_token');

        $this->classifiedRepository->createItem($params);

        return redirect()->route('my-ad.index');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function saveAsDraft(Request $request)
    {
        $params = $request->except('_token');

        $this->classifiedRepository->draftItem($params);

        return redirect()->route('my-ad.index');
    }

    /**
     * Show the specified resource.
     * @param $slug
     * @return Renderable
     */
    public function show($slug)
    {
        $data['classified'] = $this->classifiedRepository->findItemByColumn('slug', $slug);
        $data['reviews'] = $data['classified']->reviews;
        $data['cartId'] = $data['classified']->cart()->whereUserId(Auth::id())->first() ? $data['classified']->cart()->whereUserId(Auth::id())->first()->id : null;
        $data['wishlistId'] = $data['classified']->wishlist()->whereUserId(Auth::id())->first() ? $data['classified']->wishlist()->whereUserId(Auth::id())->first()->id : null;

        return view('classified::show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Renderable
     */
    public function edit()
    {
        $data['categories'] = $this->classifiedRepository->listItems(['id', 'name']);
        $data['item'] = $this->classifiedRepository->findItemByColumn('id', request()->id);

        return view('classified::profile.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $params = $request->except('_token');

        $this->classifiedRepository->updateItem($params);

        return redirect()->route('my-ad.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return RedirectResponse
     */
    public function destroy()
    {
        $this->classifiedRepository->deleteItem(request()->id);

        toast('Ad Deleted', 'success');

        return redirect()->route('my-ad.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function searchAndFilter($type, $slug = null)
    {
        $data['recentItems'] = Classified::select('id', 'title', 'slug')->latest()->limit(6)->get();
        $data['items'] = $this->classifiedRepository->searchAndFilterItem($type, $slug);
        $data['filterableAttributes'] = $this->classifiedRepository->getFilterAttributes($type);

        $category = $slug ? $slug : $type;

        $data['categories'] = Category::whereParentId(Category::whereSlug($category)->pluck('id'))
            ->with('children')
            ->select('id', 'name')
            ->get();

        return view('classified::filter.index', $data);
    }

    public function filtering()
    {

        $attributes = Attribute::select('name', 'options')
            ->whereCategory('jobs')
            ->whereIsFilterable(true)
            ->get();

        foreach ($attributes as $attribute) {
            $attribute->display_name = $attribute->name;
            $attribute->name = Str::of($attribute->name)->lower()->snake()->__toString();
            if (!$attribute->options) {
                $items = ClassifiedAttribute::where('name', $attribute->name)
                    ->with('classified')->whereHas('classified', function ($query) {
                        $query->where('type', 'jobs');
                    })->select('name', 'value', 'classified_id')->get()->unique('value');

                $options = [];

                foreach ($items as $item) {
                    array_push($options, $item->value);
                }

                $attribute->options = $options;
            }
        }

        dd($attributes);


        dd(collect($options));

        $filterQueries = request()->all();

        $items = Classified::with('attributes');

        foreach ($filterQueries as $key => $value) {
            $items->whereHas('attributes', function ($query) use ($key, $value) {
                $query->where('name', $key)
                    ->whereIn('value', $value);
            });
        }

        dd($items->get());
    }
}
