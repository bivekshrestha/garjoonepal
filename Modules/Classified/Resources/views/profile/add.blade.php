@extends('profile::layout')

@section('meta')
    <x-meta-tag></x-meta-tag>
@endsection

@section('css')
    <style>
        .mapboxgl-ctrl-geocoder--input {
            padding: 6px 35px !important;
        }
    </style>
@endsection

@section('childContent')
    <div>
        <div
            class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h5>Select Type</h5>
        </div>
        <div class="row">
            <form
                action="{{ route('my-ad.create') }}"
                method="POST"
                class="col-6 col-md-4 mt-3"
            >
                @csrf
                <input type="hidden" name="type" value="services">

                <button class="btn btn-primary px-5 py-3 w-100">{{ trans('classified::form.types.services') }}</button>
            </form>
            <form
                action="{{ route('my-ad.create') }}"
                method="POST"
                class="col-6 col-md-4 mt-3"
            >
                @csrf
                <input type="hidden" name="type" value="jobs">

                <button class="btn btn-primary px-5 py-3 w-100">{{ trans('classified::form.types.jobs') }}</button>
            </form>
            <form
                action="{{ route('my-ad.create') }}"
                method="POST"
                class="col-6 col-md-4 mt-3"
            >
                @csrf
                <input type="hidden" name="type" value="motor-vehicles">

                <button class="btn btn-primary px-5 py-3 w-100">{{ trans('classified::form.types.motor_vehicles') }}</button>
            </form>
            <form
                action="{{ route('my-ad.create') }}"
                method="POST"
                class="col-6 col-md-4 mt-3"
            >
                @csrf
                <input type="hidden" name="type" value="real-estate">

                <button class="btn btn-primary px-5 py-3 w-100">{{ trans('classified::form.types.real_estate') }}</button>
            </form>
            <form
                action="{{ route('my-ad.create') }}"
                method="POST"
                class="col-6 col-md-4 mt-3"
            >
                @csrf
                <input type="hidden" name="type" value="accommodation">

                <button class="btn btn-primary px-5 py-3 w-100">{{ trans('classified::form.types.accommodation') }}</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
@endsection
