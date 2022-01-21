@extends('site::layouts.master')

@section('css')
@endsection

@push('styles')
@endpush

@section('meta')
    <x-meta-tag></x-meta-tag>
@endsection

@section('content')
    <!-- Breadcrumb starts here -->
    <div class="mybreadcrumb">
        <div class="container">
            <div class="row d-flex justify-content-center mt-100">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-block">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('home') }}" data-abc="true" class="text-dark">
                                            <i class="fa fa-home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="#" data-abc="true" class="text-dark fw-bold">Store</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end -->
    <!-- Services page Starts here -->
    <section class="">
        <div class="mystore myproducts">
            <div class="container">
                <div class="row">
                    @foreach($stores as $store)
                        <div class="col-md-4 mb-3">
                            <div class="mystore1 bg-white p-3 shadow">
                                <div class="company_logo store_logo  d-flex">
                                    <img
                                        src="{{ asset($store->image) }}"
                                        class="img-fluid"
                                        width="50px"
                                        height="50px"
                                        alt="{{ $store->name }}"
                                    >
                                    <div class="company_text store_text text-left  ms-3">
                                        <a href="{{ route('store.show', $store->slug) }}" class="text-dark h6">
                                            <strong>{{ $store->name }}</strong>
                                        </a>
                                        <div class="supplier-details">
                                            <ul class="list-unstyled">
                                                <li>
                                                <span class="sup_timecountry">
                                                    <span class="badge rounded-pill bg-success">
                                                        <small>{{ $store->address }}</small>
                                                    </span>
                                                </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    @foreach($store->limited_products as $product)
                                        <div class="col-md-6">
                                            <div class="country_store1 store_para">
                                                <x-product-card
                                                    :product="$product"
                                                ></x-product-card>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--Services page ends here -->

    <!-- CTA button starts -->
    @include('site::pages.includes.cta')

@endsection

@section('js')
@endsection

@push('script')
@endpush
