@extends('admin::layouts.master')

@section('css')
@endsection

@push('styles')
@endpush

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add City</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a type="button" class="btn btn-sm btn-outline-secondary" href="{{ route('admin.city.index') }}">
                Go Back
            </a>
        </div>
    </div>

    <div class="pt-3 pb-2 mb-3">
        <form
            action="{{ route('admin.country.store') }}"
            method="POST"
        >
            @csrf

            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            placeholder="Enter Name"
                            value="{{ old('name') }}"
                        >
                        <label for="name">Name</label>
                        @error('name')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary px-5">{{ trans('admin::form.saveBtnText') }}</button>
        </form>
    </div>
@endsection

@section('js')
@endsection

@push('script')
@endpush
