@extends('profile::layout')

@section('meta')
    <x-meta-tag></x-meta-tag>
@endsection

@section('childContent')
    <div>
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h5>Update Your Own Store</h5>
        </div>
        <form
            action="{{ route('my-store.update') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            <input type="hidden" name="id" value="{{ $store->id }}">
            <input type="hidden" name="user_id" value="{{ $store->user_id }}">

            <div class="row">
                <div class="col-12 col-md-4 mb-3">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            name="name"
                            placeholder="{{ trans('store::store.form.placeholders.name') }}"
                            value="{{ $store->name }}"
                        >
                        <label for="name" class="required">{{ trans('store::store.form.name') }}</label>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-3">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control"
                            id="email"
                            name="email"
                            placeholder="{{ trans('store::store.form.placeholders.email') }}"
                            value="{{ $store->email }}"
                        >
                        <label for="email" class="required">{{ trans('store::store.form.email') }}</label>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-3">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control"
                            id="number"
                            name="number"
                            placeholder="{{ trans('store::store.form.placeholders.number') }}"
                            value="{{ $store->number }}"
                        >
                        <label for="number" class="required">{{ trans('store::store.form.number') }}</label>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-3">
                    <div class="form-floating">
                        <select
                            class="form-control"
                            id="country_id"
                            name="country_id"
                        >
                            <option disabled selected>{{ trans('store::store.form.country_id') }}</option>
                            @foreach($countries as $key => $value)
                                <option
                                    value="{{ $key }}"
                                    @if($key == $store->country_id) selected @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                        <label for="country_id" class="required">{{ trans('store::store.form.country_id') }}</label>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-3">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control"
                            id="address"
                            name="address"
                            placeholder="{{ trans('store::store.form.placeholders.address') }}"
                            value="{{ $store->address }}"
                        >
                        <label for="address" class="required">{{ trans('store::store.form.address') }}</label>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-3">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control"
                            id="postal_code"
                            name="postal_code"
                            placeholder="{{ trans('store::store.form.placeholders.postal_code') }}"
                            value="{{ $store->postal_code }}"
                        >
                        <label for="postal_code" class="required">{{ trans('store::store.form.postal_code') }}</label>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-3">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control"
                            id="web_url"
                            name="web_url"
                            placeholder="{{ trans('store::store.form.placeholders.web_url') }}"
                            value="{{ $store->web_url }}"
                        >
                        <label for="web_url" class="required">{{ trans('store::store.form.web_url') }}</label>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                </div>

                <div class="col-12 col-md-12 mb-3">
                    <div class="form-floating">
                        <textarea
                            type="text"
                            class="form-control"
                            id="description"
                            name="description"
                            placeholder="{{ trans('store::store.form.placeholders.description') }}"
                            style="height: 100px;"
                        >{{ $store->description }}</textarea>
                        <label for="description" class="required">{{ trans('store::store.form.description') }}</label>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-3">
                    <div class="">
                        <label for="image" class="required">{{ trans('store::store.form.image') }}</label>
                        <input
                            type="file"
                            class="form-control"
                            id="image"
                            name="image"
                            placeholder="{{ trans('store::store.form.placeholders.image') }}"
                            value="{{ $store->image }}"
                        >

                        <div class="invalid-feedback d-block"></div>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary px-5">{{ trans('store::store.form.updateBtnText') }}</button>
        </form>
    </div>
@endsection
