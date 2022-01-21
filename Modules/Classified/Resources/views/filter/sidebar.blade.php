<div class="product_cat_card">


    <div class="search-filter">
        <form action="#">

            <!-- Category Filter -->
            @if($categories->count() > 0)
                <h3 class="title"><span>Categories</span></h3>
                <div class="widget-inner">

                    <form method="get" action="{{ route('ad.filter', request('type')) }}" class="mb-4">

                        <x-other-filter-inputs self="category"></x-other-filter-inputs>
                        <div class="dropdown">
                            <a
                                class="btn border rounded-0 dropdown-toggle w-100 text-start loc_text d-flex justify-content-between align-items-center"
                                href="#"
                                role="button"
                                id="dropdownMenuLink"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                --- Please Select the Category ---
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                @foreach($categories as $category)
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="custom-control custom-checkbox d-flex align-items-center">
                                                <input
                                                    type="checkbox"
                                                    class="custom-control-input me-2"
                                                    id="cat-{{$category->id}}"
                                                    name="category[]"
                                                    value="{{ $category->id }}"
                                                    onchange="this.form.submit()"
                                                    @if(request()->has('category') && in_array($category->id, request('category'))) checked @endif
                                                >
                                                <label
                                                    class="custom-control-label"
                                                    for="cat-{{$category->id}}"
                                                >
                                                    {{ $category->name }}
                                                </label>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </form>
                </div>
            @endif
        <!-- End of Category Filter -->


            <!-- Price Filter -->
            <h3 class="title"><span>Salary</span></h3>
            <div class="widget-inner">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="in1">
                        <form method="get" action="{{ route('ad.filter', request('type')) }}">
                            <x-other-filter-inputs self="min_price"></x-other-filter-inputs>
                            <input
                                id="min_price"
                                name="min_price"
                                class="form-control"
                                placeholder="Min"
                                value="{{ request('min_price') }}"
                                onchange="this.form.submit()"
                            >
                        </form>
                    </div>
                    <div class="in1 px-3">
                        <span>to</span>
                    </div>
                    <div class="in1">
                        <form method="get" action="{{ route('ad.filter', request('type')) }}">
                            <x-other-filter-inputs self="max_price"></x-other-filter-inputs>
                            <input
                                id="max_price"
                                name="max_price"
                                class="form-control"
                                placeholder="Max"
                                value="{{ request('max_price') }}"
                                onchange="this.form.submit()"
                            >
                        </form>
                    </div>
                </div>
            </div>
            <!-- End of Price Filter -->

            @foreach($filterableAttributes as $attribute)
                <h3 class="title"><span>{{ $attribute->display_name }}</span></h3>
                <div class="widget-inner">
                    <form method="get" action="{{ route('ad.filter', request('type')) }}" class="mb-4">

                        <x-other-filter-inputs :self="$attribute->name"></x-other-filter-inputs>

                        <div class="dropdown">
                            <a
                                class="btn border rounded-0 dropdown-toggle w-100 text-start loc_text d-flex justify-content-between align-items-center"
                                href="#"
                                role="button"
                                id="dropdownMenuLink"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                --- Please Select the {{ $attribute->display_name }} ---
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                @foreach($attribute->options as $option)
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="custom-control custom-checkbox d-flex align-items-center">
                                                <input
                                                    type="checkbox"
                                                    class="custom-control-input me-2"
                                                    id="{{ $attribute->name . '_' . \Illuminate\Support\Str::snake($option) . '_' . $loop->iteration }}"
                                                    value="{{ $option }}"
                                                    name="{{ $attribute->name }}[]"
                                                    onchange="this.form.submit()"
                                                    @if(request()->has($attribute->name) && in_array($option, request($attribute->name))) checked @endif
                                                >
                                                <label
                                                    class="custom-control-label"
                                                    for="{{ $attribute->name . '_' . \Illuminate\Support\Str::snake($option) . '_' . $loop->iteration }}"
                                                >
                                                    {{ $option }}
                                                </label>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </form>
                </div>
            @endforeach
        </form>
    </div>
</div>
