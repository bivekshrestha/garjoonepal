@extends('admin::layouts.master')

@section('css')
@endsection

@push('styles')
@endpush

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Category</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a type="button" class="btn btn-sm btn-outline-secondary" href="{{ route('admin.category.index') }}">
                Go Back
            </a>
        </div>
    </div>

    <div class="pt-3 pb-2 mb-3">
        <form
            action="{{ route('admin.category.update') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            <input type="hidden" name="id" value="{{ $item->id }}">

            <div class="form-row">
                <div class="form-group col-12 col-md-4">
                    <label for="name">Name</label>
                    <input
                        type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        id="name"
                        name="name"
                        placeholder="Enter Category Name"
                        value="{{ $item->name }}"
                    >
                    @error('name')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group col-12 col-md-4">
                    <label for="parent_id">Parent</label>
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
                                @if($item->parent_id == $category->id) selected @endif
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('parent_id')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group col-12 col-md-4">
                    <label for="position">Position</label>
                    <input
                        type="number"
                        class="form-control @error('position') is-invalid @enderror"
                        id="position"
                        name="position"
                        placeholder="Enter Category Position"
                        value="{{ $item->position }}"
                    >
                    @error('position')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group col-12 col-md-4">
                    <label for="icon">Icon</label>
                    <input
                        type="text"
                        class="form-control @error('icon') is-invalid @enderror"
                        id="icon"
                        name="icon"
                        placeholder="Enter Category Icon"
                        value="{{ $item->icon }}"
                    >
                    @error('icon')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group col-12 col-md-4">
                    <label for="status">Status</label>
                    <select
                        type="text"
                        class="form-control @error('status') is-invalid @enderror"
                        id="status"
                        name="status"
                    >
                        <option value="1" @if($item->status == 1) selected @endif>Active</option>
                        <option value="0" @if($item->status == 0) selected @endif>Inactive</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group col-12 col-md-4">
                    <label for="image">Image</label>
                    <input
                        type="file"
                        class="custom-file @error('image') is-invalid @enderror"
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

            <button type="submit" class="btn btn-primary px-5">Update</button>
        </form>
    </div>
@endsection

@section('js')
@endsection

@push('script')
@endpush
