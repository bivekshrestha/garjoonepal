<div class="product_cat_card">

    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h6 class="h4">Filters</h6>
        <a href="{{ route('product.filter') }}" class="btn btn-primary btn-sm rounded-0">Clear</a>
    </div>

    <div class="search-filter">
        <!-- Category Filter -->
        @if($categories->count() > 0)
            <h3 class="title"><span>Categories</span></h3>
            <div class="widget-inner">

                <form method="get" action="{{ route('product.filter') }}" class="mb-4">

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
        <h3 class="title"><span>Price</span></h3>
        <div class="widget-inner">
            <div class="d-flex align-items-center justify-content-between">
                <div class="in1">
                    <form method="get" action="{{ route('product.filter') }}">
                        <x-other-filter-inputs self="min_price"></x-other-filter-inputs>
                        <input
                            id="min_price"
                            name="min_price"
                            class="form-control"
                            placeholder="Min Price"
                            value="{{ request('min_price') }}"
                            onchange="this.form.submit()"
                        >
                    </form>
                </div>
                <div class="in1 px-3">
                    <span>to</span>
                </div>
                <div class="in1">
                    <form method="get" action="{{ route('product.filter') }}">
                        <x-other-filter-inputs self="max_price"></x-other-filter-inputs>
                        <input
                            id="max_price"
                            name="max_price"
                            class="form-control"
                            placeholder="Max Price"
                            value="{{ request('max_price') }}"
                            onchange="this.form.submit()"
                        >
                    </form>
                </div>
            </div>
        </div>
        <!-- End of Price Filter -->

        <!-- Location Filter -->
        <h3 class="title"><span>Location</span></h3>
        <div class="widget-inner">

        </div>
        <div class="widget-inner">
            <form method="get" action="{{ route('product.filter') }}" class="mb-4">

                <x-other-filter-inputs self="city"></x-other-filter-inputs>

                <div class="dropdown">
                    <a
                        class="btn border rounded-0 dropdown-toggle w-100 text-start loc_text d-flex justify-content-between align-items-center"
                        href="#"
                        role="button"
                        id="dropdownMenuLink"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        --- Please Select the Location ---
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        @foreach($locations as $location)
                            <li>
                                <a class="dropdown-item" href="#">
                                    <div class="custom-control custom-checkbox d-flex align-items-center">
                                        <input
                                            type="checkbox"
                                            class="custom-control-input me-2"
                                            id="loc-{{Str::slug($location)}}"
                                            name="city[]"
                                            value="{{ $location }}"
                                            onchange="this.form.submit()"
                                            @if(request()->has('city') && in_array($location, request('city'))) checked @endif
                                        >
                                        <label
                                            class="custom-control-label"
                                            for="loc-{{Str::slug($location)}}"
                                        >
                                            {{ $location }}
                                        </label>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </form>
        </div>
        <!-- End of Location Filter -->
    </div>
</div>
