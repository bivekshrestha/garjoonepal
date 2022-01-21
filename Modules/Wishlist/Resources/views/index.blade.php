@extends('site::layouts.master')

@section('css')
@endsection

@push('styles')
@endpush

@section('meta')
    <x-meta-tag></x-meta-tag>
@endsection

@section('content')
    <!-- Wishlist page Starts here -->
    <section class="pt-50">
        <div class="container">
            <div class="mywishlist">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="cart-table">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Total</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td>
                                            <div class="cart-product-thumb">
                                                <a href="{{ route('product.show', $item->product->slug) }}">
                                                    <img
                                                        src="{{ asset($item->product->thumbnail->path) }}"
                                                        class="rounded-circle"
                                                        alt="image"
                                                        height="80"
                                                        width="80"
                                                    >
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="cart-product-name">
                                                <h5>
                                                    <a href="{{ route('product.show', $item->product->slug) }}">{{ $item->product->title }}</a>
                                                </h5>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="cart-product-price">$ {{ $item->product->price }}</span>
                                        </td>

                                        <td>
                                            <x-move-to-cart :wishlistId="$item->id"></x-move-to-cart>
                                        </td>
                                        <td>
                                            <x-add-to-wishlist :productId="$item->product->id"
                                                               :wishlistId="$item->id"></x-add-to-wishlist>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12 d-flex w-auto me-auto mt-3">
                            <a href="{{ route('home') }}" class="  btn-search btn btn-hover-primary p-2 rounded-0 border-0">
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Wishlist page ends here -->

    <!-- CTA button starts -->
    @include('site::pages.includes.cta')

@endsection

@section('js')
@endsection

@push('script')
@endpush
