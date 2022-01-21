@extends('site::layouts.master')

@section('css')
@endsection

@push('styles')
@endpush

@section('meta')
    <x-meta-tag></x-meta-tag>
@endsection

@section('content')
    <div class="container my_profile my-5">
        <div class="row">
            <div class="col-3">
                @include('profile::sidebar')
            </div>

            <div class="col-9 pb-5 bg-white">
                <div class="container">
                    @yield('childContent')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection

@push('script')
@endpush
