@extends('site::layouts.master')

@section('css')
@endsection

@push('styles')
@endpush

@section('meta')
    <x-meta-tag></x-meta-tag>
@endsection

@section('content')
    <form
        id="order-form"
        action="{{ route('order.store') }}"
        method="POST"
    >
        @csrf
        <section class="pt-50">
            <div class="container">
                <div class="proceedtocheckout">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card shadow-lg ">

                                <div class="row justify-content-around">
                                    <div class="col-md-5">
                                        <div class="card border-0">
                                            <div class="card-header pt-4 pb-0">
                                                <h4 class="card-title fw-bold ">Checkout</h4>
                                            </div>
                                            <div class="card-body">

                                                <div class="row ">
                                                    <div class="col">
                                                        <p class="text-muted mb-2">Delivery Details</p>
                                                        <hr class="mt-0">
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <div class="form-floating">
                                                            <select
                                                                type="text"
                                                                id="shipping_area"
                                                                name="shipping_area"
                                                                class="form-control"
                                                            >
                                                                <option value="inside" selected>Inside Kathmandu
                                                                    Valley
                                                                </option>
                                                                <option value="outside">Outside Kathmandu Valley
                                                                </option>
                                                            </select>
                                                            <label
                                                                for="shipping_area">{{ trans('order::order.shipping_area') }}</label>
                                                        </div>
                                                        <div class="invalid-feedback d-block"></div>
                                                    </div>

                                                    <div class="col-12 mb-3">
                                                        <div class="form-floating">
                                                            <input
                                                                type="text"
                                                                id="shipping_address"
                                                                name="shipping_address"
                                                                class="form-control"
                                                                placeholder="{{ trans('order::order.placeholders.shipping_address') }}"
                                                            >
                                                            <label
                                                                for="shipping_address">{{ trans('order::order.shipping_address') }}</label>
                                                        </div>
                                                        <div class="invalid-feedback d-block"></div>
                                                    </div>

                                                    <div class="col-12 mb-3">
                                                        <div class="form-floating">
                                                            <input
                                                                type="text"
                                                                id="receiver_name"
                                                                name="receiver_name"
                                                                class="form-control"
                                                                placeholder="{{ trans('order::order.placeholders.receiver_name') }}"
                                                            >
                                                            <label
                                                                for="receiver_name">{{ trans('order::order.receiver_name') }}</label>
                                                        </div>
                                                        <div class="invalid-feedback d-block"></div>
                                                    </div>

                                                    <div class="col-12 mb-3">
                                                        <div class="form-floating">
                                                            <input
                                                                type="text"
                                                                id="receiver_number"
                                                                name="receiver_number"
                                                                class="form-control"
                                                                placeholder="{{ trans('order::order.placeholders.receiver_number') }}"
                                                            >
                                                            <label
                                                                for="receiver_number">{{ trans('order::order.receiver_number') }}</label>
                                                        </div>
                                                        <div class="invalid-feedback d-block"></div>
                                                    </div>

                                                    <div class="col-12 mb-3">
                                                        <div class="form-floating">
                                                            <input
                                                                type="text"
                                                                id="email"
                                                                name="receiver_email"
                                                                class="form-control"
                                                                placeholder="{{ trans('order::order.placeholders.receiver_email') }}"
                                                            >
                                                            <label
                                                                for="receiver_email">{{ trans('order::order.receiver_email') }}</label>
                                                        </div>
                                                        <div class="invalid-feedback d-block"></div>
                                                    </div>
                                                </div>

                                                <x-verify-email></x-verify-email>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="card border-0 ">
                                            <div class="card-header card-2">
                                                <p class="card-text text-muted mt-md-4 mb-2 space">YOUR ORDER
                                                    {{--                                                    <span class=" small text-muted ml-2 cursor-pointer">EDIT SHOPPING BAG</span>--}}
                                                </p>
                                                <hr class="my-2">
                                            </div>
                                            <div class="card-body pt-0">
                                                @foreach($items as $item)
                                                    <div class="row justify-content-between">
                                                        <div class="col-auto col-md-7">
                                                            <div class="media flex-column flex-sm-row d-flex">
                                                                <img
                                                                    class=" img-fluid"
                                                                    src="{{ asset($item->product->thumbnail->path) }}"
                                                                    width="62"
                                                                    height="62"
                                                                    alt="{{ $item->product->title }}"
                                                                >
                                                                <div class="media-body my-auto">
                                                                    <div class="row ">
                                                                        <div class="col-auto ms-3">
                                                                            <p class="mb-0">
                                                                                <b>{{ $item->product->title }}</b>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class=" pl-0 flex-sm-col col-auto my-auto ">
                                                            <p><b>$ {{ $item->product->price }}</b></p>
                                                            @if($item->product->discount)
                                                                <p>
                                                                    $ {{ $item->product->price - $item->product->price * $item->product->discount->rate /100 }}
                                                                    ({{ $item->product->discount->rate }}% OFF)
                                                                </p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <hr class="my-2">
                                                @endforeach
                                                <div class="row ">
                                                    <div class="col">
{{--                                                        <div class="row justify-content-between">--}}
{{--                                                            <div class="col-4">--}}
{{--                                                                <p class="mb-1">--}}
{{--                                                                    <b>Subtotal</b>--}}
{{--                                                                </p>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="flex-sm-col col-auto">--}}
{{--                                                                <p class="mb-1">--}}
{{--                                                                    <b>Rs.1000</b>--}}
{{--                                                                </p>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
                                                        <div class="row justify-content-between">
                                                            <div class="col">
                                                                <p class="mb-1">
                                                                    <b>Shipping</b>
                                                                </p>
                                                            </div>
                                                            <div class="flex-sm-col col-auto">
                                                                <p class="mb-1">
                                                                    <b><span id="shipping-charge">0</span></b>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-between mt-3">
                                                            <div class="col-4">
                                                                <p>
                                                                    <b>Total</b>
                                                                </p>
                                                            </div>
                                                            <div class="flex-sm-col col-auto">
                                                                <p class="mb-1">
                                                                    <b>
                                                                        $
                                                                        <span id="grand-total">
                                                                        @php
                                                                            $total = 0;
                                                                              foreach ($items as $item){
                                                                                      if($item->product->discount){
                                                                                          $total += $item->product->price - $item->product->price * $item->product->discount->rate /100;
                                                                                      } else {
                                                                                          $total += $item->product->price;
                                                                                      }
                                                                              }
                                                                            echo $total;
                                                                        @endphp
                                                                        </span>
                                                                    </b>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <hr class="my-0">
                                                    </div>
                                                </div>
                                                <div class="row mb-5 mt-4 ">
                                                    <p class="fw-bold mb-4">
                                                        Note: Shipping is free for order of more than Rs. 5000
                                                    </p>
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-group">
                                                            {{--                                                            <label for="otp">{{ trans('order::order.otp') }}</label>--}}
                                                            <input
                                                                type="number"
                                                                id="otp"
                                                                name="otp"
                                                                class="form-control"
                                                                placeholder="{{ trans('order::order.placeholders.otp') }}"
                                                            >
                                                        </div>
                                                        {{--                                                        <div class="invalid-feedback d-block"></div>--}}
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <button
                                                            class="btn-search btn btn-hover-primary p-2 px-5 rounded-0
                                                                 bg-theme border-0 d-flex align-items-center ms-auto"
                                                            type="button"
                                                            id="submit-btn"
                                                        >
                                                            {{ trans('order::order.saveBtnText') }}
                                                        </button>
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
        </section>
    </form>

    @include('site::pages.includes.cta')
@endsection

@section('js')
    <script src="{{ asset('js/validation/order.js') }}"></script>
    <script>
        $('#shipping_area').change(function () {
            let total = $('#grand-total');
            if ($(this).val() === 'outside') {
                $('#shipping-charge').text(10)
                total.text(parseInt(total.text()) + 10)
            }
        });
    </script>
@endsection

@push('script')
@endpush
