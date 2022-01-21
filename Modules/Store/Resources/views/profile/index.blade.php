@extends('profile::layout')

@section('meta')
    <x-meta-tag></x-meta-tag>
@endsection

@section('childContent')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header bg-app-primary" style="height:150px">
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl col-lg flex-grow-0" style="flex-basis:230px">
                                <div class="img-thumbnail shadow w-100 bg-white position-relative text-center p-1"
                                     style="margin-top:-120px">
                                    <img src="{{ asset($store->image ? $store->image : 'static/site/store.png') }}"
                                         class="center-xy img-fluid img-thumbnail" alt="Logo Brand"
                                         style="height:200px; width:200px;">
                                </div>
                            </div>
                            <!--  col.// -->
                            <div class="col-xl col-lg">
                                <h3>{{ $store->name }}</h3>
                                <p>{{ $store->address }}</p>
                            </div>
                            <!--  col.// -->
                            <div class="col-xl-4 text-md-end">
                                <a class="btn btn-outline-app-secondary"
                                   href="{{ route('my-store.edit', $store->slug) }}">Edit Details</a>
                            </div>
                            <!--  col.// -->
                        </div>
                        <!-- card-body.// -->
                        <hr class="my-4">
                        <div class="row g-4">
                            <div class="col-md-12 col-lg-4 col-xl-2">
                                <article class="box">
                                    <p class="mb-0 text-muted">Total Products:</p>
                                    <h5 class="text-app-primary">{{ $store->products->count() }}</h5>
                                    <p class="mb-0 text-muted">Total Sales:</p>
                                    <h5 class="text-app-primary mb-0">$ 2380</h5>
                                </article>
                            </div>
                            <!--  col.// -->
                            <div class="col-sm-6 col-lg-4 col-xl-3">
                                <h6 class="text-muted">Contact</h6>
                                <p>
                                   @checkNull($store->email)
                                    <br>
                                    @checkNull($store->web_url)
                                    <br>
                                    @checkNull($store->number)
                                </p>
                            </div>
                            <!--  col.// -->
                            <div class="col-sm-6 col-lg-4 col-xl-3">
                                <h6 class="text-muted">Address</h6>
                                <p>
                                    @checkNull($store->address)
                                    <br>
                                    @checkNull($store->postal_code)
                                    <br>
                                    {{ $store->country->name }}
                                </p>
                            </div>
                            <!--  col.// -->
                            <div class="col-sm-6 col-xl-4 text-xl-end">

                            </div>
                            <!--  col.// -->
                        </div>
                        <!--  row.// -->
                    </div>
                    <!--  card-body.// -->
                </div>
            </div>
        </div>
    </div>
@endsection
