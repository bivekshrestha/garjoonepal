@extends('site::layouts.master')

@section('css')
@endsection

@push('styles')
@endpush

@section('meta')
    <x-meta-tag></x-meta-tag>
@endsection

@section('content')
    <div class="container pb-5">
        <div class="row">
            <div class="col-12 col-md-3">
                <h6>Order Summary</h6>
                <div class="row">
                    @foreach($items as $item)
                        <div class="card col-12 p-3">
                            <div class="card-body d-flex align-items-center">
                                <div class="me-4">
                                    <img src="{{ asset($item->product->thumbnail->path) }}" alt="image" height="80"
                                         width="80">
                                </div>
                                <div>
                                    <div>{{ $item->product->title }}</div>
                                    <div class="@if($item->product->discount) text-decoration-line-through @endif">
                                        $ {{ $item->product->price }}
                                    </div>
                                    @if($item->product->discount)
                                        <div>
                                            $ {{ $item->product->price - $item->product->price * $item->product->discount->rate /100 }}
                                            ({{ $item->product->discount->rate }}% OFF)
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <h6>
                    Shipping Charge: <span id="shipping-charge">0</span>
                </h6>
                <h6>
                    Grand Total: $
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
                </h6>
            </div>
            <div class="col-12 col-md-9">
                <form
                    id="order-form"
                    action="{{ route('order.store') }}"
                    method="POST"
                >
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    id="receiver_name"
                                    name="receiver_name"
                                    class="form-control"
                                    placeholder="{{ trans('order::order.placeholders.receiver_name') }}"
                                >
                                <label for="receiver_name">{{ trans('order::order.receiver_name') }}</label>
                            </div>
                            <div class="invalid-feedback d-block"></div>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    id="receiver_number"
                                    name="receiver_number"
                                    class="form-control"
                                    placeholder="{{ trans('order::order.placeholders.receiver_number') }}"
                                >
                                <label for="receiver_number">{{ trans('order::order.receiver_number') }}</label>
                            </div>
                            <div class="invalid-feedback d-block"></div>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    id="email"
                                    name="receiver_email"
                                    class="form-control"
                                    placeholder="{{ trans('order::order.placeholders.receiver_email') }}"
                                >
                                <label for="receiver_email">{{ trans('order::order.receiver_email') }}</label>
                            </div>
                            <div class="invalid-feedback d-block"></div>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-floating">
                                <input
                                    type="number"
                                    id="otp"
                                    name="otp"
                                    class="form-control"
                                    placeholder="{{ trans('order::order.placeholders.otp') }}"
                                >
                                <label for="otp">{{ trans('order::order.otp') }}</label>
                            </div>
                            <div class="invalid-feedback d-block"></div>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-floating">
                                <select
                                    type="text"
                                    id="shipping_area"
                                    name="shipping_area"
                                    class="form-control"
                                >
                                    <option value="inside" selected>Inside Kathmandu Valley</option>
                                    <option value="outside">Outside Kathmandu Valley</option>
                                </select>
                                <label for="shipping_area">{{ trans('order::order.shipping_area') }}</label>
                            </div>
                            <div class="invalid-feedback d-block"></div>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    id="shipping_address"
                                    name="shipping_address"
                                    class="form-control"
                                    placeholder="{{ trans('order::order.placeholders.shipping_address') }}"
                                >
                                <label for="shipping_address">{{ trans('order::order.shipping_address') }}</label>
                            </div>
                            <div class="invalid-feedback d-block"></div>
                        </div>

                    </div>

                    <x-verify-email></x-verify-email>

                    <button type="button" class="btn btn-primary px-5" id="submit-btn">
                        {{ trans('order::order.saveBtnText') }}
                    </button>
                </form>
            </div>

        </div>
    </div>
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
