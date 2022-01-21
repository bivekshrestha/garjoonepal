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
                    <div class="col-md-4">
                        @include('product::filter.sidebar')
                    </div>

                    <div class="col-md-8">
                        <div class="category_right">
                            <!-- main heading -->
                            <div class="col-12">
                                  <div class="title-section">
                                    <div class="row ">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <!-- title section Start -->
                                            <div class="title1">
                                                <h3 class="title">Available Products</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 py-2">
                                <strong>Selected Filters: </strong>
                                @foreach(request()->all() as $key => $item)
                                    @if(is_array($item))
                                        @foreach($item as $value)
                                            <small
                                                class="ms-2 border border-secondary px-2 py-1 rounded-pill">{{ $value }}</small>
                                        @endforeach
                                    @else
                                        <small class="ms-2 border border-secondary px-2 py-1 rounded-pill">{{ $item }}</small>
                                    @endif
                                @endforeach
                            </div>

                            <div class="row">
                                @foreach($products as $product)
                                    <div class="col-md-3">
                                        <x-product-card
                                            :product="$product"
                                        ></x-product-card>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="row col-12 mt-3">
                            {{ $products->appends(request()->input())->links() }}
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
    {{--    <script>--}}
    {{--        $(document).ready(function () {--}}
    {{--            $('.my_select').select2({--}}
    {{--                theme: 'bootstrap-5',--}}
    {{--                placeholder: "Select data"--}}
    {{--            });--}}
    {{--        });--}}
    {{--    </script>--}}
@endsection

@push('script')
@endpush
