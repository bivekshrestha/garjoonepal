@extends('site::layouts.master')

@section('css')
@endsection

@push('styles')
@endpush

@section('meta')
    <x-meta-tag></x-meta-tag>
@endsection
@section('content')
    <section class="pt-50">
        <div class="container">
            <div class="myproducts">
                <div class="row">
                    <div class="col-md-3">
                        @include('classified::filter.sidebar')
                    </div>

                    <div class="col-md-9">
                        @if ($recentItems->count() > 0)
                            <div class="recent_list">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="title-section">
                                            <div class="row ">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <!-- title section Start -->
                                                    <div class="title1">
                                                        <h3 class="title"><i class="fas fa-fire"></i>
                                                            Hot {{ \App\Helpers\Helper::getCategoryName(request('type')) }}
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="owl-carousel owl-theme relatedproducts">
                                    @foreach($recentItems as $recent)
                                        <div class="item">
                                            <div class="brands_item d-flex flex-column justify-content-center">
                                                @if($recent->thumbnail)
                                                    <img
                                                        src="{{ asset($recent->thumbnail->path) }}"
                                                        alt="{{ $recent->title }}"
                                                    >
                                                @endif
                                                <p class="text-center fw-bold">{{ \Illuminate\Support\Str::limit($recent->title, 10) }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($items->count() > 0)
                                <div class="old_list pt-50">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="title-section">
                                                <div class="row ">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <!-- title section Start -->
                                                        <div class="title1">
                                                            <h3 class="title">
                                                                Other {{ \App\Helpers\Helper::getCategoryName(request('type')) }}</h3>
                                                        </div>
                                                        <div class="d-none d-sm-flex pb-3">
                                                            <a
                                                                class="btn btn-icon nav-link-style bg-light text-dark  opacity-100 mr-2"
                                                                data-bs-toggle="tooltip"
                                                                data-placement="bottom"
                                                                title="Grid view"
                                                                id="grid"
                                                            >
                                                                <i class="fa fa-th-large"></i>
                                                            </a>
                                                            <a
                                                                class="btn btn-icon nav-link-style bg-light text-dark  opacity-100 mr-2"
                                                                data-bs-toggle="tooltip"
                                                                data-placement="bottom"
                                                                title="List View"
                                                                id="list"
                                                            >
                                                                <i class="fa fa-th-list"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if (count(request()->all()) > 0)
                                            <div class="col-12 py-2">
                                                <strong>Selected Filters: </strong>
                                                @foreach(request()->all() as $key => $item)
                                                    @if(is_array($item))
                                                        @foreach($item as $value)
                                                            <small
                                                                class="ms-2 border border-secondary px-2 py-1 rounded-pill">{{ $value }}</small>
                                                        @endforeach
                                                    @else
                                                        <small
                                                            class="ms-2 border border-secondary px-2 py-1 rounded-pill">{{ $item }}</small>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    <div class="mylisting myproducts">
                                        <div class="row   view-group" id="products">
                                            @foreach($items as $item)
                                                <div class="col-md-3 myitem">
                                                    <div class="item">
                                                        <div class="brands_item d-flex flex-column justify-content-center">
                                                            <div class="item-inner">
                                                                <div class="product_det">
                                                                    <div class="product_card clearfix img-event">
                                                                        <a
                                                                            class="product_image product_more"
                                                                            title="{{ $item->title }}"
                                                                            href="#"
                                                                        >
                                                                <span class="product_image">
                                                                    @if($item->thumbnail)
                                                                        <img
                                                                            src="{{ asset($item->thumbnail->path) }}"
                                                                            alt="{{ $item->title }}"
                                                                        >
                                                                    @endif
                                                                </span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="item-info">
                                                                        <div class="product_details">
                                                                            <div class="product_head">
                                                                                <a title="{{ $item->title }}" href="#">
                                                                                    {{ $item->title }}
                                                                                </a>
                                                                            </div>
                                                                            <div class="product_price">
                                                                                <div class="product_price_main">
                                                                            <span class="product_regular"><span
                                                                                    class="price"><span class="price1">Rs.  {{ $item->price }}</span></span></span>
                                                                                    {{--                                                                            <div class="myrating">--}}
                                                                                    {{--                                                                                <i class="fas fa-star fa-x"></i>--}}
                                                                                    {{--                                                                                <i class="fas fa-star fa-x"></i>--}}
                                                                                    {{--                                                                                <i class="fas fa-star fa-x"></i>--}}
                                                                                    {{--                                                                                <i class="fas fa-star fa-x"></i>--}}
                                                                                    {{--                                                                            </div>--}}
                                                                                    <div class="newpara text-start ms-3">
                                                                                        <div class="row g-0 ">
                                                                                            <div class="col-md-8 m-auto">
                                                                                                <div class="grid_det p-3">
                                                                                                    <h6 class="fw-bold mb-0">
                                                                                                        <a href="#">
                                                                                                            {{ $item->title }}
                                                                                                        </a>
                                                                                                    </h6>
                                                                                                    <p class=" mb-2">
                                                                                                        <small
                                                                                                            class="fw-bold text-muted">Added
                                                                                                            on: {{ $item->created_at->format('d-M-Y') }}</small>
                                                                                                    </p>

                                                                                                    <p>
                                                                                                        {{ \Illuminate\Support\Str::limit($item->description, 200) }}
                                                                                                    </p>
                                                                                                    <span class="fw-bold">
                                                                                                @if ($item->contact_number)
                                                                                                            Contact Number:
                                                                                                            <a href="#">
                                                                                                    {{ $item->contact_number }}
                                                                                                </a> |
                                                                                                        @endif
                                                                                                Location : {{ $item->address }}
                                                                                            </span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4 m-auto ">
                                                                                                <h6 class="fw-bold mb-0">
                                                                                                    Rs. {{ $item->price }}</h6>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                        @endif

                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- CTA button starts -->
    @include('site::pages.includes.cta')
@endsection

@section('js')
@endsection

@push('script')
@endpush
