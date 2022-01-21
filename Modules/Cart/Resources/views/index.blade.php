@extends('site::layouts.master')

@section('css')
@endsection

@push('styles')
@endpush

@section('meta')
    <x-meta-tag></x-meta-tag>
@endsection

@section('content')
    <!-- Add to cart page Starts here -->
    <section class="pt-50">
        <div class="container">
            <div class="addtocart">
                <div class="row">
                    @if(count($items) > 0)

                        <div class="col-md-8">
                            <div class="cart_left">
                                <div class="pb-5">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

                                                <!-- Shopping cart table -->
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col" class="border-0 bg-light">
                                                                <div class="p-2 px-3 text-capitalize">Product</div>
                                                            </th>
                                                            <th scope="col" class="border-0 bg-light">
                                                                <div class="py-2 text-capitalize">Price</div>
                                                            </th>
                                                            <th scope="col" class="border-0 bg-light">
                                                                <div class="py-2 text-capitalize">Discount</div>
                                                            </th>
                                                            <th scope="col" class="border-0 bg-light">
                                                                <div class="py-2 text-capitalize">Remove</div>
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($items as $item)
                                                            <tr @if($loop->iteration > 1) class="border-top" @endif>
                                                                <th scope="row" class="border-0">
                                                                    <div class="p-2">
                                                                        <img
                                                                            src="{{ asset($item->product->thumbnail->path) }}"
                                                                            alt="{{ $item->product->title }}"
                                                                            width="50"
                                                                            class="img-fluid rounded shadow-sm rounded-circle"
                                                                        >
                                                                        <div class="ms-3 d-inline-block align-middle">
                                                                            <h6 class="mb-0">
                                                                                <a
                                                                                    href="#"
                                                                                    class="text-dark fw-bold d-inline-block align-middle">
                                                                                    {{ $item->product->title }}
                                                                                </a>
                                                                            </h6>
                                                                            <span
                                                                                class="text-dark fw-normal font-italic d-block text-sm">
                                                                            Category: {{ $item->product->category->name }}
                                                                        </span>
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                                <td class="border-0 align-middle">
                                                                    <strong>$ {{ $item->product->price }}</strong>
                                                                </td>
                                                                <td class="border-0 align-middle">
                                                                    @if($item->product->discount)
                                                                        <strong>$ {{ $item->product->discount->rate }}</strong>
                                                                    @else
                                                                        -
                                                                    @endif
                                                                </td>
                                                                <td class="border-0 align-middle">
                                                                    <x-add-to-cart :productId="$item->product->id"
                                                                                   :cartId="$item->id"></x-add-to-cart>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- End -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="cart_right bg-white p-2">
                                <div class="bg-light rounded-pill px-4 py-3 text-uppercase fw-bold">Order summary</div>
                                <div class="p-4 pt-0">
                                    <p class="fst-italic mb-4">Shipping and additional costs are calculated based on
                                        values
                                        you have entered.</p>
                                    <ul class="list-unstyled mb-4">
                                        <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                                class="text-muted">Order Subtotal </strong><strong>$390.00</strong></li>
                                        <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                                class="text-muted">Shipping and handling</strong><strong>$10.00</strong>
                                        </li>
                                        <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                                class="text-muted">Tax</strong><strong>$0.00</strong></li>
                                        <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                                class="text-muted">Total</strong>
                                            <h5 class="font-weight-bold">$400.00</h5>
                                        </li>
                                    </ul>
                                    <a href="{{ route('order') }}"
                                       class="btn bg-white text-center px-3 font-weight-bold mybtn">
                                        Proceed to Checkout
                                    </a>
                                </div>
                            </div>
                        </div>

                    @else
                        <div class="col-12 text-center">
                            <h5 class="bg-white py-5 px-3">It seems your cart is empty. Please, add some items and visit
                                your cart again.</h5>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- Add to cart page Starts here -->

    <!-- CTA button starts -->
    @include('site::pages.includes.cta')
@endsection

@section('js')
@endsection

@push('script')
@endpush
