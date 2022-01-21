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
                                        <a href="{{ route('store') }}" data-abc="true"
                                           class="text-dark fw-bold">Store</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="#" data-abc="true" class="text-dark fw-bold">{{ $store->name }}</a>
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

    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="job_left store_all bg-white p-3">
                        <img src="{{ asset('static/img/products/store.jpg') }}" alt="" class="img-fluid">
                        <div class="jobimg storeimg">
                            <img
                                class="p-2 z-index-9 align-self-start shadow"
                                width="90px"
                                height="90px"
                                src="{{ asset($store->image) }}"
                                alt="{{ $store->name }}"
                            >
                        </div>

                        <div class="storepara">
                            <p>
                                {{ $store->description }}
                            </p>
                        </div>

                        <div class="category_right myproducts mt-3">
                            <!-- main heading -->
                            <div class="col-12">
                                <div class="title-section">
                                    <div class="row ">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <!-- title section Start -->
                                            <div class="title1">
                                                <h3 class="title">Products</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @foreach($store->products as $product)
                                <div class="col-md-2">
                                    <x-product-card
                                        :product="$product"
                                    ></x-product-card>
                                </div>
                                @endforeach
                            </div>
                        </div>
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
