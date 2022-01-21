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
            <h5 class="text-capitalize">Add New {{ $mainCategory }}</h5>
        </div>
        <form
            action="{{ route('my-ad.store') }}"
            method="POST"
            enctype="multipart/form-data"
            id="classified-form"
        >
            @csrf

            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="type" value="{{ $type }}">

            <div class="row">

                <!-- Title -->
                <div class="col-12 col-md-4 mb-3">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control"
                            id="title"
                            name="title"
                            placeholder="{{ trans('classified::form.placeholders.title') }}"
                            value="{{ old('title') }}"
                        >
                        <label for="title" class="required">{{ trans('classified::form.title') }}</label>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                </div>

                <!-- Price -->
                <div class="col-12 col-md-4 mb-3">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control"
                            id="price"
                            name="price"
                            placeholder="{{ trans('classified::form.placeholders.price') }}"
                            value="{{ old('price') }}"
                        >
                        <label for="price" class="required">{{ trans('classified::form.price') }}</label>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                </div>

                <!-- Address -->
                <div class="col-12 col-md-4 mb-3">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control"
                            id="address"
                            name="address"
                            placeholder="{{ trans('classified::form.placeholders.address') }}"
                            value="{{ old('address') }}"
                        >
                        <label for="address" class="required">{{ trans('classified::form.address') }}</label>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                </div>

                <!-- Description -->
                <div class="col-12 col-md-12 mb-3">
                    <div class="form-floating">
                        <textarea
                            type="text"
                            class="form-control"
                            id="description"
                            name="description"
                            placeholder="{{ trans('classified::form.placeholders.description') }}"
                            style="height: 100px;"
                        >{{ old('description') }}</textarea>
                        <label for="description" class="required">{{ trans('classified::form.description') }}</label>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <hr>
                </div>

                <!-- Category -->
                <div class="col-12 col-md-4 mb-3">
                    <div class="form-floating">
                        <select
                            class="form-control"
                            id="category_id"
                            name="category_id"
                        >
                            <option disabled selected>{{ trans('classified::form.category_id') }}</option>
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
                        <label for="category_id" class="required">{{ trans('classified::form.category_id') }}</label>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <hr>
                </div>

                <!-- Attributes -->
                @foreach($attributes as $attribute)
                    <div class="col-12 col-md-4 mb-3">
                        <div class="form-floating">
                            @if($attribute->type == 'text')
                                <input
                                    type="text"
                                    class="form-control"
                                    id="attribute_{{ str_replace('-', '_', $attribute->slug) }}"
                                    name="attribute_{{ str_replace('-', '_', $attribute->slug) }}"
                                    placeholder="Enter {{ $attribute->name }}"
                                >
                            @elseif($attribute->type == 'select')
                                <select
                                    class="form-control"
                                    id="attribute_{{ str_replace('-', '_', $attribute->slug) }}"
                                    name="attribute_{{ str_replace('-', '_', $attribute->slug) }}"
                                >
                                    <option selected disabled>Please select {{ $attribute->name }}</option>
                                    @foreach($attribute->options as $option)
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endforeach
                                </select>
                            @endif
                            <label for="attribute_{{ str_replace('-', '_', $attribute->slug) }}" class="required">{{ $attribute->name }}</label>
                            <div class="invalid-feedback d-block"></div>
                        </div>
                    </div>
                @endforeach

                <div class="col-12 mb-3">
                    <hr>
                </div>

                <!-- Images -->
                <div class="col-12 col-md-6 mb-3">
                    <label for="images" class="required">{{ trans('classified::form.images') }}</label>
                    <input
                        type="file"
                        class="form-control"
                        id="images"
                        name="images[]"
                        placeholder="{{ trans('classified::form.placeholders.images') }}"
                        value="{{ old('images') }}"
                        multiple
                        accept="image/*"
                    >
                    <div class="invalid-feedback"></div>
                </div>

                <div class="col-12 mb-3">
                    <hr>
                </div>

            </div>

            <!-- Map -->
            <div class="row">
                <div class="col-12 mb-3">
                    <div id="geocoder" class="geocoder"></div>
                    <div id="map"></div>
                    <input type="hidden" name="map_lng_lat" id="map_lng_lat" value="">
                    <div class="invalid-feedback d-block"></div>
                </div>
            </div>

            <button class="btn btn-primary px-5">{{ trans('classified::form.saveBtnText') }}</button>
            <button type="button" id="saveAsDraft"
                    class="btn btn-primary px-5">{{ trans('classified::form.saveAsDraftBtnText') }}</button>
            {{--            <button class="btn btn-primary px-5">{{ trans('classified::form.previewBtnText') }}</button>--}}
        </form>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/validation/classified.js') }}"></script>
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

        $('#saveAsDraft').click(function () {
            let form = $('#classified-form');

            $('input, select, textarea').each(function () {
                $(this).addClass('ignore');
            })

            $('#title').removeClass('ignore')
            $('#category_id').removeClass('ignore')

            form.attr('action', '/profile/my-ad/draft');
            form.submit();
        })
    </script>
@endsection
