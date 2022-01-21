@extends('site::layouts.master')

@section('css')
@endsection

@push('styles')
@endpush

@section('meta')
    <x-meta-tag></x-meta-tag>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <div class="my-4 d-flex justify-content-between align-items-center">
                    <h6 class="h4">Filters</h6>
                    <a href="{{ route('product.filter') }}" class="btn btn-primary btn-sm">Reset</a>
                </div>

                <form method="get" action="{{ route('product.filter') }}" class="mb-4">
                    <x-other-filter-inputs self="min_price"></x-other-filter-inputs>
                    <div class="form-floating">
                        <input
                            id="min_price"
                            name="min_price"
                            class="form-control"
                            placeholder="Min Price"
                            value="{{ request('min_price') }}"
                            onchange="this.form.submit()"
                        >
                        <label for="min_price">Min Price</label>
                    </div>
                </form>

                <form method="get" action="{{ route('product.filter') }}" class="mb-4">
                    <x-other-filter-inputs self="max_price"></x-other-filter-inputs>
                    <div class="form-floating">
                        <input
                            id="max_price"
                            name="max_price"
                            class="form-control"
                            placeholder="Max Price"
                            value="{{ request('max_price') }}"
                            onchange="this.form.submit()"
                        >
                        <label for="max_price">Max Price</label>
                    </div>
                </form>

                <form method="get" action="{{ route('product.filter') }}" class="mb-4">

                    <x-other-filter-inputs self="category"></x-other-filter-inputs>

                    {{--                    <div class="form-floating">--}}
                    <label for="category">Category: </label>
                    <select
                        class="form-control my_select invisible"
                        id="category"
                        name="category[]"
                        onchange="this.form.submit()"
                        multiple="multiple"
                    >
                        @foreach($categories as $category)
                            @if($category->children)
                                @foreach($category->children as $child)
                                    <option
                                        value="{{ $child->id }}"
                                        @if(request()->has('category') && in_array($child->id, request('category'))) selected @endif
                                    >
                                        {{ $child->name }}
                                    </option>
                                @endforeach
                            @else
                                <option
                                    value="{{ $category->id }}"
                                    @if(request()->has('category') && in_array($category->id, request('category'))) selected @endif
                                >
                                    {{ $category->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>

                    {{--                    </div>--}}
                </form>

                <form method="get" action="{{ route('product.filter') }}" class="mb-4">

                    <x-other-filter-inputs self="city"></x-other-filter-inputs>
                    <label for="city">Location: </label>
                    <select
                        class="form-control my_select invisible"
                        id="city"
                        name="city[]"
                        onchange="this.form.submit()"
                        multiple="multiple"
                    >
                        @foreach($locations as $location)
                            <option
                                value="{{ $location }}"
                                @if(request()->has('city') && in_array($location, request('city'))) selected @endif
                            >
                                {{ $location }}
                            </option>
                        @endforeach
                    </select>


                </form>

                <form method="get" action="{{ route('product.filter') }}" class="mb-4">

                    <x-other-filter-inputs self="sort_by"></x-other-filter-inputs>

                    <div class="form-floating">
                        <select
                            class="form-control"
                            id="sort_by"
                            name="sort_by"
                            onchange="this.form.submit()"
                        >
                            <option selected disabled>Select to sort</option>
                            <option
                                value="oldest"
                                @if(request('sort_by') == 'oldest') selected @endif
                            >
                                Oldest
                            </option>
                            <option
                                value="latest"
                                @if(request('sort_by') == 'latest') selected @endif
                            >
                                Latest
                            </option>
                            <option
                                value="low_high"
                                @if(request('sort_by') == 'low_high') selected @endif
                            >
                                Low to High
                            </option>
                            <option
                                value="high_low"
                                @if(request('sort_by') == 'high_low') selected @endif
                            >
                                High to Low
                            </option>

                        </select>
                        <label for="sort_by">Sort By: </label>
                    </div>
                </form>
            </div>
            <div class="col-9">
                <div class="row justify-content-between align-items-center mb-4">
                    <div class="col-6">
                        Showing 1 to 20 of 100
                    </div>
                    <div class="col-2">

                    </div>
                </div>
                <div class="row">
                    @foreach($products as $product)
                        <x-product-card :product="$product"></x-product-card>
                    @endforeach
                </div>
                <div class="row col-12">
                    {{ $products->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('.my_select').select2({
                theme: 'bootstrap-5',
                placeholder: "Select data"
            });
        });
    </script>
@endsection

@push('script')
@endpush
