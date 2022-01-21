@extends('profile::layout')

@section('meta')
    <x-meta-tag></x-meta-tag>
@endsection

@section('css')
    <style>
        .mapboxgl-ctrl-geocoder--input {
            padding: 6px 35px !important;
        }

        #map{
            height: 300px;
        }
    </style>
@endsection

@section('childContent')
    <div>
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h5>Add New Product</h5>
        </div>
        <form
            action="{{ route('my-product.store') }}"
            method="POST"
            enctype="multipart/form-data"
            id="product-form"
        >
            @csrf

            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="store_id" value="{{ Auth::user()->store->id }}">

            <div class="row">
                <div class="col-12 col-md-4 mb-3">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control"
                            id="title"
                            name="title"
                            placeholder="{{ trans('product::form.placeholders.title') }}"
                            value="{{ old('title') }}"
                        >
                        <label for="title" class="required">{{ trans('product::form.title') }}</label>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-3">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control"
                            id="price"
                            name="price"
                            placeholder="{{ trans('product::form.placeholders.price') }}"
                            value="{{ old('price') }}"
                        >
                        <label for="price" class="required">{{ trans('product::form.price') }}</label>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-3">
                    <div class="form-floating">
                        <select
                            class="form-control"
                            id="category_id"
                            name="category_id"
                        >
                            <option disabled selected>{{ trans('product::form.category_id') }}</option>
                            @foreach($categories as $category)
                                @if($category->children->count() > 0)
                                    <optgroup label="{{ $category->name }}">
                                        @foreach($category->children as $child)
                                            <option
                                                value="{{ $child->id }}"
                                                @if($child->id == old('category_id')) selected @endif
                                            >{{ $child->name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endif
                            @endforeach
                            <optgroup label="Others">
                                @foreach($categories as $category)
                                    @if($category->children->count() == 0)
                                        <option
                                            value="{{ $category->id }}"
                                            @if($category->id == old('category_id')) selected @endif
                                        >{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                        </select>
                        <label for="category_id" class="required">{{ trans('product::form.category_id') }}</label>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-3">
                    <div class="form-floating">
                        <select
                            class="form-control"
                            id="city"
                            name="city"
                        >
                            <option disabled selected>{{ trans('product::form.placeholder.city') }}</option>
                            @foreach($cities as $city)
                                <option
                                    value="{{ $city }}"
                                    @if($city == old('city')) selected @endif
                                >{{ $city }}</option>
                            @endforeach
                        </select>
                        <label for="city" class="required">{{ trans('product::form.city') }}</label>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-3">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control"
                            id="address"
                            name="address"
                            placeholder="{{ trans('product::form.placeholders.address') }}"
                            value="{{ old('address') }}"
                        >
                        <label for="address" class="required">{{ trans('product::form.address') }}</label>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                </div>

                <div class="col-12 col-md-12 mb-3">
                    <div class="form-floating">
                        <textarea
                            type="text"
                            class="form-control"
                            id="description"
                            name="description"
                            placeholder="{{ trans('product::form.placeholders.description') }}"
                            style="height: 100px;"
                        >{{ old('description') }}</textarea>
                        <label for="description" class="required">{{ trans('product::form.description') }}</label>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-3">
                    <div class="form-floating">
                        <input
                            type="number"
                            class="form-control"
                            id="rate"
                            name="rate"
                            placeholder="{{ trans('product::form.placeholders.rate') }}"
                            value="{{ old('rate') }}"
                        >
                        <label for="rate" class="required">{{ trans('product::form.rate') }}</label>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-3">
                    <div class="form-floating">
                        <input
                            type="date"
                            class="form-control"
                            id="starts_on"
                            name="starts_on"
                            placeholder="{{ trans('product::form.placeholders.starts_on') }}"
                            value="{{ old('starts_on') }}"
                        >
                        <label for="starts_on" class="required">{{ trans('product::form.starts_on') }}</label>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-3">
                    <div class="form-floating">
                        <input
                            type="date"
                            class="form-control"
                            id="ends_on"
                            name="ends_on"
                            placeholder="{{ trans('product::form.placeholders.ends_on') }}"
                            value="{{ old('ends_on') }}"
                        >
                        <label for="ends_on" class="required">{{ trans('product::form.ends_on') }}</label>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label for="images" class="required">{{ trans('product::form.images') }}</label>
                    <input
                        type="file"
                        class="form-control"
                        id="images"
                        name="images[]"
                        placeholder="{{ trans('product::form.placeholders.images') }}"
                        value="{{ old('images') }}"
                        multiple
                        accept="image/*"
                    >
                    <div class="invalid-feedback"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mb-3">
                    <div id="geocoder" class="geocoder"></div>
                    <div id="map"></div>
                    <input type="hidden" name="map_lng_lat" id="map_lng_lat" value="">
                    <div class="invalid-feedback d-block"></div>
                </div>

            </div>


            <button class="btn btn-primary px-5">{{ trans('product::form.saveBtnText') }}</button>
            <button type="button" id="saveAsDraft" class="btn btn-primary px-5">{{ trans('product::form.saveAsDraftBtnText') }}</button>
            {{--            <button class="btn btn-primary px-5">{{ trans('product::form.previewBtnText') }}</button>--}}
        </form>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/validation/product.js') }}"></script>
    <script>

        let map = new mapboxgl.Map({
            container: 'map', // container ID
            style: 'mapbox://styles/mapbox/streets-v11', // style URL
            center: [85.31187299999999, 27.713177], // starting position [lng, lat]
            zoom: 9 // starting zoom
        });

        // Add the control to the map.
        let geocoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            mapboxgl: mapboxgl,
            placeholder: 'Search for places',

        });

        document.getElementById('geocoder').appendChild(geocoder.onAdd(map));
        mapInput = $(".mapboxgl-ctrl-geocoder--input")
        mapInput.attr('name', 'map_address')
        mapInput.attr('id', 'map_address')
        mapInput.addClass('form-control')

        geocoder.on('result', function (e) {
            let center = e.result.center;
            let lng_lat = `${center[0]}, ${center[1]}`;
            $('[name="map_lng_lat"]').val(lng_lat);
        });

        $('#saveAsDraft').click(function (){
            let form = $('#product-form');

            $('input, select, textarea').each(function (){
                $(this).addClass('ignore');
            })

            $('#title').removeClass('ignore')
            $('#category_id').removeClass('ignore')

            form.attr('action', '/profile/my-product/draft');
            form.submit();
        })
    </script>
@endsection
