@extends('admin::layouts.master')

@section('css')
@endsection

@push('styles')
@endpush

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Category</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a type="button" class="btn btn-sm btn-outline-secondary" href="{{ route('admin.category.index') }}">
                Go Back
            </a>
        </div>
    </div>

    <div class="pt-3 pb-2 mb-3">
        <form
            action="{{ route('admin.category.store') }}"
            method="POST"
            enctype="multipart/form-data"
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
                            placeholder="Enter Category Name"
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

                <div class="col-12 col-md-6 mb-3">
                    <div class="form-floating">
                        <select
                            type="text"
                            class="form-control @error('position') is-invalid @enderror"
                            id="parent_id"
                            name="parent_id"
                        >
                            <option value="null" selected disabled>Select a parent</option>
                            @foreach($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    @if(old('parent_id') == $category->id) selected @endif
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <label for="parent_id">Parent</label>
                        @error('parent_id')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <div class="form-floating">
                        <input
                            type="number"
                            class="form-control @error('position') is-invalid @enderror"
                            id="position"
                            name="position"
                            placeholder="Enter Category Position"
                            value="{{ old('position') }}"
                        >
                        <label for="position">Position</label>
                        @error('position')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control @error('icon') is-invalid @enderror"
                            id="icon"
                            name="icon"
                            placeholder="Enter Category Icon"
                            value="{{ old('icon') }}"
                        >
                        <label for="icon">Icon</label>
                        @error('icon')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <div class="form-floating">
                        <select
                            type="text"
                            class="form-control @error('status') is-invalid @enderror"
                            id="status"
                            name="status"
                        >
                            <option value="1" selected>Active</option>
                            <option value="0" @if(old('status') == 0) selected @endif>Inactive</option>
                        </select>
                        <label for="status">Status</label>
                        @error('status')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label for="image">Image</label>
                    <input
                        type="file"
                        class="form-control @error('image') is-invalid @enderror"
                        id="image"
                        name="image"
                        placeholder="Enter Category Image"
                    >

                    @error('image')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary px-5">Save</button>
        </form>
    </div>
@endsection

@section('js')
@endsection

@push('script')
@endpush
